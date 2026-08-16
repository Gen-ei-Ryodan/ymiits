<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeAngkaController extends Controller
{
    public function index()
    {
        $homes = Home::all();

        return view('admin.home.index', compact('homes'));
    }

    public function create()
    {
        return view('admin.home.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_penerima_manfaat' => 'required|integer|min:0',
            'foto_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_1')) {
            $data['foto_1'] = $request->file('foto_1')->store('home_images', 'public');
        }

        if ($request->hasFile('foto_2')) {
            $data['foto_2'] = $request->file('foto_2')->store('home_images', 'public');
        }

        Home::create($data);

        return redirect()->route('admin.homeangka.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Home $homeangka)
    {
        return view('admin.home.edit', ['home' => $homeangka]);
    }

    public function update(Request $request, Home $homeangka)
    {
        $request->validate([
            'jumlah_penerima_manfaat' => 'required|integer|min:0',
            'foto_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_1')) {
            $data['foto_1'] = $request->file('foto_1')->store('home_images', 'public');
        }

        if ($request->hasFile('foto_2')) {
            $data['foto_2'] = $request->file('foto_2')->store('home_images', 'public');
        }

        $homeangka->update($data);

        return redirect()->route('admin.homeangka.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Home $homeangka)
    {
        $homeangka->delete();

        return redirect()->route('admin.homeangka.index')->with('success', 'Data berhasil dihapus.');
    }
}
