<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonis = Testimoni::orderBy('urutan', 'asc')->get();
        return view('admin.profile.testimoni.index', compact('testimonis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profile.testimoni.create');
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
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'nama_pemberi' => 'required|string|max:255',
            'is_active' => 'boolean',
            'urutan' => 'nullable|integer'
        ]);
        
        $data = $request->all();
        
        // Set default values
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        
        if (empty($data['urutan'])) {
            // Set urutan to max+1 if not specified
            $maxUrutan = Testimoni::max('urutan');
            $data['urutan'] = $maxUrutan ? $maxUrutan + 1 : 1;
        }
        
        Testimoni::create($data);
        
        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        return view('admin.profile.testimoni.show', compact('testimoni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        return view('admin.profile.testimoni.edit', compact('testimoni'));
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
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'nama_pemberi' => 'required|string|max:255',
            'is_active' => 'boolean',
            'urutan' => 'nullable|integer'
        ]);
        
        $testimoni = Testimoni::findOrFail($id);
        
        $data = $request->all();
        
        // Set active status
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        
        $testimoni->update($data);
        
        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();
        
        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
    
    /**
     * Toggle the active status of the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->is_active = !$testimoni->is_active;
        $testimoni->save();
        
        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Status testimoni berhasil diubah.');
    }
}