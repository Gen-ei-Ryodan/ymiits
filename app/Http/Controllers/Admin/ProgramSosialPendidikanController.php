<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramSosialPendidikan;
use App\Models\SubProgramSosialPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramSosialPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programSosialPendidikan = ProgramSosialPendidikan::with('subPrograms')->first();
        return view('admin.program.sosial-pendidikan.index', compact('programSosialPendidikan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (ProgramSosialPendidikan::exists()) {
            return redirect()->route('admin.sosial-pendidikan.index')
                ->with('error', 'Data program sosial pendidikan sudah ada. Silahkan edit data yang sudah ada.');
        }
        
        return view('admin.program.sosial-pendidikan.create');
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
        
        $program = ProgramSosialPendidikan::create([
            'deskripsi' => $request->deskripsi,
        ]);
        
        if ($request->has('sub_programs')) {
            foreach ($request->sub_programs as $subProgram) {
                $fotoPath = null;
                
                if (isset($subProgram['foto']) && $subProgram['foto']) {
                    $foto = $subProgram['foto'];
                    $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$foto->getClientOriginalExtension();
                    $foto->storeAs('public/program/sosial_pendidikan/sub', $namaFoto);
                    $fotoPath = $namaFoto;
                }
                
                $program->subPrograms()->create([
                    'judul' => $subProgram['judul'],
                    'deskripsi' => $subProgram['deskripsi'],
                    'foto' => $fotoPath,
                ]);
            }
        }
        
        return redirect()->route('admin.sosial-pendidikan.index')
            ->with('success', 'Data program sosial pendidikan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programSosialPendidikan = ProgramSosialPendidikan::with('subPrograms')->findOrFail($id);
        return view('admin.program.sosial-pendidikan.show', compact('programSosialPendidikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programSosialPendidikan = ProgramSosialPendidikan::findOrFail($id);
        return view('admin.program.sosial-pendidikan.edit', compact('programSosialPendidikan'));
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
        
        $programSosialPendidikan = ProgramSosialPendidikan::findOrFail($id);
        $programSosialPendidikan->update(['deskripsi' => $request->deskripsi]);
        
        return redirect()->route('admin.sosial-pendidikan.index')
            ->with('success', 'Deskripsi program sosial pendidikan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programSosialPendidikan = ProgramSosialPendidikan::findOrFail($id);
        
        // Delete associated sub-programs
        foreach ($programSosialPendidikan->subPrograms as $subProgram) {
            if ($subProgram->foto) {
                Storage::delete('public/program/sosial_pendidikan/sub/'.$subProgram->foto);
            }
            $subProgram->delete();
        }
        
        $programSosialPendidikan->delete();
        
        return redirect()->route('admin.sosial-pendidikan.index')
            ->with('success', 'Data program sosial pendidikan berhasil dihapus');
    }
}