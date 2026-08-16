<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeagamaan;
use App\Models\SubProgramKeagamaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProgramKeagamaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $programKeagamaan = ProgramKeagamaan::with('subPrograms')->first();
            return view('admin.program.keagamaan.index', compact('programKeagamaan'));
        } catch (\Exception $e) {
            Log::error('Error menampilkan program keagamaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data program keagamaan.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (ProgramKeagamaan::exists()) {
                return redirect()->route('admin.keagamaan.index')
                    ->with('error', 'Data program keagamaan sudah ada. Silahkan edit data yang sudah ada.');
            }

            return view('admin.program.keagamaan.create');
        } catch (\Exception $e) {
            Log::error('Error memuat form program keagamaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat form tambah program.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Check if program already exists
            if (ProgramKeagamaan::exists()) {
                return redirect()->route('admin.keagamaan.index')
                    ->with('error', 'Data program keagamaan sudah ada. Silahkan edit data yang sudah ada.');
            }
            
            $request->validate([
                'deskripsi' => 'required|string',
                'sub_programs.*.judul' => 'required|string|max:255',
                'sub_programs.*.deskripsi' => 'required|string',
                'sub_programs.*.foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $program = ProgramKeagamaan::create([
                'deskripsi' => $request->deskripsi,
            ]);

            if (isset($request->sub_programs) && is_array($request->sub_programs)) {
                foreach ($request->sub_programs as $subProgram) {
                    $fotoPath = null;

                    if (isset($subProgram['foto']) && $subProgram['foto']) {
                        $foto = $subProgram['foto'];
                        $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$foto->getClientOriginalExtension();
                        $foto->storeAs('public/program/keagamaan/sub', $namaFoto);
                        $fotoPath = $namaFoto;
                    }

                    $program->subPrograms()->create([
                        'judul' => $subProgram['judul'],
                        'deskripsi' => $subProgram['deskripsi'],
                        'foto' => $fotoPath,
                    ]);
                }
            }

            DB::commit();
            
            return redirect()->route('admin.keagamaan.index')
                ->with('success', 'Data program keagamaan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error menyimpan program keagamaan: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $programKeagamaan = ProgramKeagamaan::with('subPrograms')->findOrFail($id);
            return view('admin.program.keagamaan.show', compact('programKeagamaan'));
        } catch (\Exception $e) {
            Log::error('Error menampilkan detail program keagamaan: ' . $e->getMessage());
            return redirect()->route('admin.keagamaan.index')
                ->with('error', 'Program keagamaan tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $programKeagamaan = ProgramKeagamaan::with('subPrograms')->findOrFail($id);
            return view('admin.program.keagamaan.edit', compact('programKeagamaan'));
        } catch (\Exception $e) {
            Log::error('Error memuat form edit program keagamaan: ' . $e->getMessage());
            return redirect()->route('admin.keagamaan.index')
                ->with('error', 'Program keagamaan tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'deskripsi' => 'required|string',
            ]);

            $program = ProgramKeagamaan::findOrFail($id);
            $program->update(['deskripsi' => $request->deskripsi]);

            return redirect()->route('admin.keagamaan.index')
                ->with('success', 'Deskripsi program keagamaan berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error update program keagamaan: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        try {
            $programKeagamaan = ProgramKeagamaan::findOrFail($id);

            // Delete any related sub programs first
            foreach ($programKeagamaan->subPrograms as $subProgram) {
                if ($subProgram->foto) {
                    Storage::delete('public/program/keagamaan/sub/'.$subProgram->foto);
                }
                $subProgram->delete();
            }

            // Delete the program itself
            $programKeagamaan->delete();
            
            DB::commit();

            return redirect()->route('admin.keagamaan.index')
                ->with('success', 'Data program keagamaan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error menghapus program keagamaan: ' . $e->getMessage());
            
            return redirect()->route('admin.keagamaan.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
