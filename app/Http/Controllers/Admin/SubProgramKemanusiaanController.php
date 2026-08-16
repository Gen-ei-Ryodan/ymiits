<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgramKemanusiaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubProgramKemanusiaanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'program_kemanusiaan_id' => 'required|exists:program_kemanusiaan,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('program_kemanusiaan_id', 'judul', 'deskripsi');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/program/kemanusiaan/sub', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        SubProgramKemanusiaan::create($data);

        return back()->with('success', 'Sub program berhasil ditambahkan');
    }

    public function index()
    {
        $subPrograms = SubProgramKemanusiaan::all();
        $programs = \App\Models\ProgramKemanusiaan::all();
        
        return view('admin.program.kemanusiaan.sub.index', compact('subPrograms', 'programs'));
    }

    public function edit($id)
    {
        $subProgram = SubProgramKemanusiaan::findOrFail($id);

        return view('admin.program.kemanusiaan.sub.edit', compact('subProgram'));
    }

    public function update(Request $request, $id)
    {
        $subProgram = SubProgramKemanusiaan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('judul', 'deskripsi');

        if ($request->hasFile('foto')) {
            if ($subProgram->foto) {
                Storage::delete('public/program/kemanusiaan/sub/'.$subProgram->foto);
            }

            $file = $request->file('foto');
            $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/program/kemanusiaan/sub', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $subProgram->update($data);

        return redirect()->route('admin.kemanusiaan.index')->with('success', 'Sub program berhasil diperbarui');
    }

    public function destroy($id)
    {
        $subProgram = SubProgramKemanusiaan::findOrFail($id);

        if ($subProgram->foto) {
            Storage::delete('public/program/kemanusiaan/sub/'.$subProgram->foto);
        }

        $subProgram->delete();

        return back()->with('success', 'Sub program berhasil dihapus');
    }
}
