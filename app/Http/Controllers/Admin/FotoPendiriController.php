<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FotoPendiri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoPendiriController extends Controller
{
    public function index()
    {
        $foto = FotoPendiri::first();

        return view('admin.profile.foto_pendiri.index', compact('foto'));
    }

    public function create()
    {
        return view('admin.profile.foto_pendiri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
        ]);

        $path = $request->file('foto')->store('foto_pendiri', 'public');

        FotoPendiri::create([
            'foto' => $path,
        ]);

        return redirect()->route('admin.foto-pendiri.index')->with('success', 'Foto berhasil disimpan.');
    }

    public function edit($id)
    {
        $foto = FotoPendiri::findOrFail($id);

        return view('admin.profile.foto_pendiri.edit', compact('foto'));
    }

    public function update(Request $request, $id)
    {
        $foto = FotoPendiri::findOrFail($id);

        $request->validate([
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($foto->foto);
            $path = $request->file('foto')->store('foto_pendiri', 'public');
            $foto->update(['foto' => $path]);
        }

        return redirect()->route('admin.foto-pendiri.index')->with('success', 'Foto berhasil diperbarui.');
    }
}
