<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgramWakaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubProgramWakafController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'program_wakaf_id' => 'required|exists:program_wakaf,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('program_wakaf_id', 'judul', 'deskripsi');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/program/wakaf/sub', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        SubProgramWakaf::create($data);

        return back()->with('success', 'Sub program berhasil ditambahkan');
    }

    public function index()
    {
        $subPrograms = SubProgramWakaf::all();
        $programs = \App\Models\ProgramWakaf::all();
        
        return view('admin.program.wakaf.sub.index', compact('subPrograms', 'programs'));
    }

    public function edit($id)
    {
        $subProgram = SubProgramWakaf::findOrFail($id);

        return view('admin.program.wakaf.sub.edit', compact('subProgram'));
    }

    public function update(Request $request, $id)
    {
        $subProgram = SubProgramWakaf::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('judul', 'deskripsi');

        if ($request->hasFile('foto')) {
            if ($subProgram->foto) {
                Storage::delete('public/program/wakaf/sub/'.$subProgram->foto);
            }

            $file = $request->file('foto');
            $namaFoto = 'sub_program_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/program/wakaf/sub', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $subProgram->update($data);

        return redirect()->route('admin.wakaf.index')->with('success', 'Sub program berhasil diperbarui');
    }

    public function destroy($id)
    {
        $subProgram = SubProgramWakaf::findOrFail($id);

        if ($subProgram->foto) {
            Storage::delete('public/program/wakaf/sub/'.$subProgram->foto);
        }

        $subProgram->delete();

        return back()->with('success', 'Sub program berhasil dihapus');
    }
}
