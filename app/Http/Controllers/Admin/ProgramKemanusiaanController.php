<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKemanusiaan;
use App\Models\SubProgramKemanusiaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramKemanusiaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programKemanusiaan = ProgramKemanusiaan::first();
        $subPrograms = null;
        
        if ($programKemanusiaan) {
            $subPrograms = SubProgramKemanusiaan::where('program_kemanusiaan_id', $programKemanusiaan->id)->get();
        }
        
        return view('admin.program.kemanusiaan.index', compact('programKemanusiaan', 'subPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exists = ProgramKemanusiaan::exists();
        
        if ($exists) {
            return redirect()->route('admin.kemanusiaan.index')
                ->with('error', 'Data program kemanusiaan sudah ada. Silahkan edit data yang sudah ada.');
        }
        
        return view('admin.program.kemanusiaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'sub_programs.*.judul' => 'required|string|max:255',
            'sub_programs.*.deskripsi' => 'required|string',
            'sub_programs.*.foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $program = ProgramKemanusiaan::create([
            'deskripsi' => $request->deskripsi,
        ]);
        
        if ($request->has('sub_programs')) {
            foreach ($request->sub_programs as $subProgram) {
                $fotoPath = null;
                
                if (isset($subProgram['foto']) && $subProgram['foto']) {
                    $foto = $subProgram['foto'];
                    $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$foto->getClientOriginalExtension();
                    $foto->storeAs('public/program/kemanusiaan/sub', $namaFoto);
                    $fotoPath = $namaFoto;
                }
                
                $program->subPrograms()->create([
                    'judul' => $subProgram['judul'],
                    'deskripsi' => $subProgram['deskripsi'],
                    'foto' => $fotoPath,
                ]);
            }
        }
        
        return redirect()->route('admin.kemanusiaan.index')
            ->with('success', 'Data program kemanusiaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programKemanusiaan = ProgramKemanusiaan::findOrFail($id);
        return view('admin.program.kemanusiaan.show', compact('programKemanusiaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programKemanusiaan = ProgramKemanusiaan::findOrFail($id);
        return view('admin.program.kemanusiaan.edit', compact('programKemanusiaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string',
        ]);
        
        $programKemanusiaan = ProgramKemanusiaan::findOrFail($id);
        $programKemanusiaan->update(['deskripsi' => $request->deskripsi]);
        
        return redirect()->route('admin.kemanusiaan.index')
            ->with('success', 'Deskripsi program kemanusiaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programKemanusiaan = ProgramKemanusiaan::findOrFail($id);
        
        // Hapus sub-program yang terkait
        $programKemanusiaan->subPrograms()->delete();
        
        $programKemanusiaan->delete();
        
        return redirect()->route('admin.kemanusiaan.index')
            ->with('success', 'Data program kemanusiaan berhasil dihapus');
    }
}