<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donaturs = Donatur::latest()->paginate(10);
        return view('admin.profile.donatur.index', compact('donaturs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profile.donatur.create');
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
            'angka_donatur' => 'required|numeric',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = [
            'angka_donatur' => $request->angka_donatur,
        ];
        
        // Handle foto uploads
        if ($request->hasFile('foto1')) {
            $foto1 = $request->file('foto1');
            $nama_foto1 = 'donatur_1_' . time() . '.' . $foto1->getClientOriginalExtension();
            $foto1->storeAs('public/donatur', $nama_foto1);
            $data['foto1'] = $nama_foto1;
        }
        
        if ($request->hasFile('foto2')) {
            $foto2 = $request->file('foto2');
            $nama_foto2 = 'donatur_2_' . time() . '.' . $foto2->getClientOriginalExtension();
            $foto2->storeAs('public/donatur', $nama_foto2);
            $data['foto2'] = $nama_foto2;
        }
        
        if ($request->hasFile('foto3')) {
            $foto3 = $request->file('foto3');
            $nama_foto3 = 'donatur_3_' . time() . '.' . $foto3->getClientOriginalExtension();
            $foto3->storeAs('public/donatur', $nama_foto3);
            $data['foto3'] = $nama_foto3;
        }
        
        Donatur::create($data);
        
        return redirect()->route('admin.donatur.index')
            ->with('success', 'Data donatur berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donatur = Donatur::findOrFail($id);
        return view('admin.profile.donatur.show', compact('donatur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donatur = Donatur::findOrFail($id);
        return view('admin.profile.donatur.edit', compact('donatur'));
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
            'angka_donatur' => 'required|numeric',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $donatur = Donatur::findOrFail($id);
        
        $data = [
            'angka_donatur' => $request->angka_donatur,
        ];
        
        // Handle foto updates
        if ($request->hasFile('foto1')) {
            // Delete old foto if exists
            if ($donatur->foto1) {
                Storage::delete('public/donatur/' . $donatur->foto1);
            }
            $foto1 = $request->file('foto1');
            $nama_foto1 = 'donatur_1_' . time() . '.' . $foto1->getClientOriginalExtension();
            $foto1->storeAs('public/donatur', $nama_foto1);
            $data['foto1'] = $nama_foto1;
        }
        
        if ($request->hasFile('foto2')) {
            if ($donatur->foto2) {
                Storage::delete('public/donatur/' . $donatur->foto2);
            }
            $foto2 = $request->file('foto2');
            $nama_foto2 = 'donatur_2_' . time() . '.' . $foto2->getClientOriginalExtension();
            $foto2->storeAs('public/donatur', $nama_foto2);
            $data['foto2'] = $nama_foto2;
        }
        
        if ($request->hasFile('foto3')) {
            if ($donatur->foto3) {
                Storage::delete('public/donatur/' . $donatur->foto3);
            }
            $foto3 = $request->file('foto3');
            $nama_foto3 = 'donatur_3_' . time() . '.' . $foto3->getClientOriginalExtension();
            $foto3->storeAs('public/donatur', $nama_foto3);
            $data['foto3'] = $nama_foto3;
        }
        
        $donatur->update($data);
        
        return redirect()->route('admin.donatur.index')
            ->with('success', 'Data donatur berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donatur = Donatur::findOrFail($id);
        
        // Delete foto files
        if ($donatur->foto1) {
            Storage::delete('public/donatur/' . $donatur->foto1);
        }
        if ($donatur->foto2) {
            Storage::delete('public/donatur/' . $donatur->foto2);
        }
        if ($donatur->foto3) {
            Storage::delete('public/donatur/' . $donatur->foto3);
        }
        
        $donatur->delete();
        
        return redirect()->route('admin.donatur.index')
            ->with('success', 'Data donatur berhasil dihapus');
    }
}