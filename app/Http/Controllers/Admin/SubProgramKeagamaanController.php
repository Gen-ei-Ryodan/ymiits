<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgramKeagamaan;
use App\Models\ProgramKeagamaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SubProgramKeagamaanController extends Controller
{
    /**
     * Show the form for creating a new sub program.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $programKeagamaanId = $request->input('program_keagamaan_id');
            
            if (!$programKeagamaanId || !ProgramKeagamaan::find($programKeagamaanId)) {
                return redirect()->route('admin.keagamaan.index')
                    ->with('error', 'Program tidak ditemukan');
            }
            
            return view('admin.program.keagamaan.sub.create', compact('programKeagamaanId'));
        } catch (\Exception $e) {
            Log::error('Error memuat form tambah sub program: ' . $e->getMessage());
            return redirect()->route('admin.keagamaan.index')
                ->with('error', 'Terjadi kesalahan saat memuat form tambah sub program.');
        }
    }
    
    /**
     * Store a newly created sub program in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $request->validate([
                'program_keagamaan_id' => 'required|exists:program_keagamaan,id',
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only('program_keagamaan_id', 'judul', 'deskripsi');

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->storeAs('public/program/keagamaan/sub', $namaFoto);
                $data['foto'] = $namaFoto;
            }

            SubProgramKeagamaan::create($data);
            
            DB::commit();

            return redirect()->route('admin.keagamaan.index')
                ->with('success', 'Sub program berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error menyimpan sub program: ' . $e->getMessage());
            
            // Clean up any uploaded files if transaction fails
            if ($request->hasFile('foto') && isset($namaFoto)) {
                Storage::delete('public/program/keagamaan/sub/'.$namaFoto);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan sub program: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified sub program.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $subProgram = SubProgramKeagamaan::findOrFail($id);
            return view('admin.program.keagamaan.sub.edit', compact('subProgram'));
        } catch (\Exception $e) {
            Log::error('Error memuat form edit sub program: ' . $e->getMessage());
            return redirect()->route('admin.keagamaan.index')
                ->with('error', 'Sub program tidak ditemukan.');
        }
    }

    /**
     * Update the specified sub program in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {
            $subProgram = SubProgramKeagamaan::findOrFail($id);

            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only('judul', 'deskripsi');
            $oldFoto = $subProgram->foto;
            $newFoto = null;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->storeAs('public/program/keagamaan/sub', $namaFoto);
                $data['foto'] = $namaFoto;
                $newFoto = $namaFoto;
            }

            $subProgram->update($data);
            
            // Delete old photo only after successful update
            if ($oldFoto && $newFoto) {
                Storage::delete('public/program/keagamaan/sub/'.$oldFoto);
            }
            
            DB::commit();

            return redirect()->route('admin.keagamaan.index')
                ->with('success', 'Sub program berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update sub program: ' . $e->getMessage());
            
            // Clean up any uploaded files if transaction fails
            if ($request->hasFile('foto') && isset($namaFoto)) {
                Storage::delete('public/program/keagamaan/sub/'.$namaFoto);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui sub program: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified sub program from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        try {
            $subProgram = SubProgramKeagamaan::findOrFail($id);
            $foto = $subProgram->foto;

            $subProgram->delete();
            
            // Delete photo only after successful deletion
            if ($foto) {
                Storage::delete('public/program/keagamaan/sub/'.$foto);
            }
            
            DB::commit();

            return redirect()->route('admin.keagamaan.index')
                ->with('success', 'Sub program berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error menghapus sub program: ' . $e->getMessage());
            
            return redirect()->route('admin.keagamaan.index')
                ->with('error', 'Terjadi kesalahan saat menghapus sub program: ' . $e->getMessage());
        }
    }
}
