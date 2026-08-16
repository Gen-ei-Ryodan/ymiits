<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgramSosialPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubProgramSosialPendidikanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'program_sosial_pendidikan_id' => 'required|exists:program_sosial_pendidikan,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('program_sosial_pendidikan_id', 'judul', 'deskripsi');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/program/sosial_pendidikan/sub', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        SubProgramSosialPendidikan::create($data);

        return back()->with('success', 'Sub program berhasil ditambahkan');
    }

    public function index()
    {
        $subPrograms = SubProgramSosialPendidikan::all();
        $programs = \App\Models\ProgramSosialPendidikan::all();
        
        return view('admin.program.sosial_pendidikan.sub.index', compact('subPrograms', 'programs'));
    }

    public function edit($id)
    {
        $subProgram = SubProgramSosialPendidikan::findOrFail($id);

        return view('admin.program.sosial_pendidikan.sub.edit', compact('subProgram'));
    }

    public function update(Request $request, $id)
    {
        $subProgram = SubProgramSosialPendidikan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('judul', 'deskripsi');

        if ($request->hasFile('foto')) {
            if ($subProgram->foto) {
                Storage::delete('public/program/sosial_pendidikan/sub/'.$subProgram->foto);
            }

            $file = $request->file('foto');
            $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/program/sosial_pendidikan/sub', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $subProgram->update($data);

        return redirect()->route('admin.sosial-pendidikan.index')->with('success', 'Sub program berhasil diperbarui');
    }

    public function destroy($id)
    {
        $subProgram = SubProgramSosialPendidikan::findOrFail($id);

        if ($subProgram->foto) {
            Storage::delete('public/program/sosial_pendidikan/sub/'.$subProgram->foto);
        }

        $subProgram->delete();

        return back()->with('success', 'Sub program berhasil dihapus');
    }
}
