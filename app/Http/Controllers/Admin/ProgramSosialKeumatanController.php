<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramSosialKeumatan;
use App\Models\SubProgramSosialKeumatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramSosialKeumatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programSosialKeumatan = ProgramSosialKeumatan::with('subPrograms')->first();
        
        return view('admin.program.sosial-keumatan.index', compact('programSosialKeumatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (ProgramSosialKeumatan::exists()) {
            return redirect()->route('admin.sosial-keumatan.index')
                ->with('error', 'Data program sosial keumatan sudah ada. Silahkan edit data yang sudah ada.');
        }
        
        return view('admin.program.sosial-keumatan.create');
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
        
        $program = ProgramSosialKeumatan::create([
            'deskripsi' => $request->deskripsi,
        ]);
        
        if ($request->has('sub_programs')) {
            foreach ($request->sub_programs as $subProgram) {
                $fotoPath = null;
                
                if (isset($subProgram['foto']) && $subProgram['foto']) {
                    $foto = $subProgram['foto'];
                    $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$foto->getClientOriginalExtension();
                    $foto->storeAs('public/program/sosial_keumatan/sub', $namaFoto);
                    $fotoPath = $namaFoto;
                }
                
                $program->subPrograms()->create([
                    'judul' => $subProgram['judul'],
                    'deskripsi' => $subProgram['deskripsi'],
                    'foto' => $fotoPath,
                ]);
            }
        }
        
        return redirect()->route('admin.sosial-keumatan.index')
            ->with('success', 'Data program sosial keumatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programSosialKeumatan = ProgramSosialKeumatan::with('subPrograms')->findOrFail($id);
        return view('admin.program.sosial-keumatan.show', compact('programSosialKeumatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programSosialKeumatan = ProgramSosialKeumatan::findOrFail($id);
        return view('admin.program.sosial-keumatan.edit', compact('programSosialKeumatan'));
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
        
        $programSosialKeumatan = ProgramSosialKeumatan::findOrFail($id);
        $programSosialKeumatan->update(['deskripsi' => $request->deskripsi]);
        
        return redirect()->route('admin.sosial-keumatan.index')
            ->with('success', 'Deskripsi program sosial keumatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programSosialKeumatan = ProgramSosialKeumatan::findOrFail($id);
        
        // Delete associated sub-programs
        foreach ($programSosialKeumatan->subPrograms as $subProgram) {
            if ($subProgram->foto) {
                Storage::delete('public/program/sosial_keumatan/sub/'.$subProgram->foto);
            }
            $subProgram->delete();
        }
        
        $programSosialKeumatan->delete();
        
        return redirect()->route('admin.sosial-keumatan.index')
            ->with('success', 'Data program sosial keumatan berhasil dihapus');
    }
}