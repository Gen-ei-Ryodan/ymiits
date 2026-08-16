<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendiriPembina;
use Illuminate\Http\Request;

class PendiriPembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PendiriPembina::orderBy('created_at', 'desc')->get();
        return view('admin.profile.pendiri-pembina.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profile.pendiri-pembina.create');
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

        PendiriPembina::create([
            'name' => $request->name,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.pendiri-pembina.index')
            ->with('success', 'Data Pendiri/Pembina berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PendiriPembina  $pendiriPembina
     * @return \Illuminate\Http\Response
     */
    public function edit(PendiriPembina $pendiriPembina)
    {
        return view('admin.profile.pendiri-pembina.edit', compact('pendiriPembina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PendiriPembina  $pendiriPembina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PendiriPembina $pendiriPembina)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $pendiriPembina->update([
            'name' => $request->name,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.pendiri-pembina.index')
            ->with('success', 'Data Pendiri/Pembina berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PendiriPembina  $pendiriPembina
     * @return \Illuminate\Http\Response
     */
    public function destroy(PendiriPembina $pendiriPembina)
    {
        $pendiriPembina->delete();

        return redirect()->route('admin.pendiri-pembina.index')
            ->with('success', 'Data Pendiri/Pembina berhasil dihapus!');
    }
}