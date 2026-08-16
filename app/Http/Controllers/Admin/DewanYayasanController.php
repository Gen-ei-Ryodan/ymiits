<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DewanYayasan;
use Illuminate\Http\Request;

class DewanYayasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DewanYayasan::orderBy('created_at', 'desc')->get();
        return view('admin.profile.dewan-yayasan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profile.dewan-yayasan.create');
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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        DewanYayasan::create([
            'name' => $request->name,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.dewan-yayasan.index')
            ->with('success', 'Data Dewan Yayasan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DewanYayasan  $dewanYayasan
     * @return \Illuminate\Http\Response
     */
    public function edit(DewanYayasan $dewanYayasan)
    {
        return view('admin.profile.dewan-yayasan.edit', compact('dewanYayasan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DewanYayasan  $dewanYayasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DewanYayasan $dewanYayasan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $dewanYayasan->update([
            'name' => $request->name,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.dewan-yayasan.index')
            ->with('success', 'Data Dewan Yayasan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DewanYayasan  $dewanYayasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DewanYayasan $dewanYayasan)
    {
        $dewanYayasan->delete();

        return redirect()->route('admin.dewan-yayasan.index')
            ->with('success', 'Data Dewan Yayasan berhasil dihapus!');
    }
}