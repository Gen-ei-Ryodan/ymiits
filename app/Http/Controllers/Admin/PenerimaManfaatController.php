<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenerimaManfaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenerimaManfaatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerimaManfaat = PenerimaManfaat::latest()->first();
        return view('admin.profile.penerima-manfaat.index', compact('penerimaManfaat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exists = PenerimaManfaat::exists();
        
        if ($exists) {
            return redirect()->route('admin.penerima-manfaat.index')
                ->with('error', 'Data penerima manfaat sudah ada. Silahkan edit data yang sudah ada.');
        }
        
        return view('admin.profile.penerima-manfaat.create');
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
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = [];
        
        // Handle foto uploads
        for ($i = 1; $i <= 6; $i++) {
            $field = 'foto'.$i;
            if ($request->hasFile($field)) {
                $foto = $request->file($field);
                $nama_foto = 'penerima_manfaat_'.$i.'_' . time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/penerima-manfaat', $nama_foto);
                $data[$field] = $nama_foto;
            }
        }
        
        PenerimaManfaat::create($data);
        
        return redirect()->route('admin.penerima-manfaat.index')
            ->with('success', 'Data penerima manfaat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penerimaManfaat = PenerimaManfaat::findOrFail($id);
        return view('admin.profile.penerima-manfaat.show', compact('penerimaManfaat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penerimaManfaat = PenerimaManfaat::findOrFail($id);
        return view('admin.profile.penerima-manfaat.edit', compact('penerimaManfaat'));
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
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto6' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $penerimaManfaat = PenerimaManfaat::findOrFail($id);
        $data = [];
        
        // Handle foto updates
        for ($i = 1; $i <= 6; $i++) {
            $field = 'foto'.$i;
            if ($request->hasFile($field)) {
                // Delete old foto if exists
                if ($penerimaManfaat->$field) {
                    Storage::delete('public/penerima-manfaat/' . $penerimaManfaat->$field);
                }
                $foto = $request->file($field);
                $nama_foto = 'penerima_manfaat_'.$i.'_' . time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('public/penerima-manfaat', $nama_foto);
                $data[$field] = $nama_foto;
            }
        }
        
        $penerimaManfaat->update($data);
        
        return redirect()->route('admin.penerima-manfaat.index')
            ->with('success', 'Data penerima manfaat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penerimaManfaat = PenerimaManfaat::findOrFail($id);
        
        // Delete foto files
        for ($i = 1; $i <= 6; $i++) {
            $field = 'foto'.$i;
            if ($penerimaManfaat->$field) {
                Storage::delete('public/penerima-manfaat/' . $penerimaManfaat->$field);
            }
        }
        
        $penerimaManfaat->delete();
        
        return redirect()->route('admin.penerima-manfaat.index')
            ->with('success', 'Data penerima manfaat berhasil dihapus');
    }
}