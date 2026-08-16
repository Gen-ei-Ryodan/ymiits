<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramWakaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramWakafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programWakaf = ProgramWakaf::first();
        $subPrograms = $programWakaf ? $programWakaf->subPrograms : collect();
        return view('admin.program.wakaf.index', compact('programWakaf', 'subPrograms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exists = ProgramWakaf::exists();
        
        if ($exists) {
            return redirect()->route('admin.wakaf.index')
                ->with('error', 'Data program wakaf sudah ada. Silahkan edit data yang sudah ada.');
        }
        
        return view('admin.program.wakaf.create');
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
            'deskripsi' => 'required|string',
        ]);
        
        $programWakaf = ProgramWakaf::create([
            'deskripsi' => $request->deskripsi,
        ]);
        
        // Handle sub programs if they exist
        if ($request->has('sub_programs')) {
            foreach ($request->sub_programs as $subProgramData) {
                if (!empty($subProgramData['judul']) && !empty($subProgramData['deskripsi'])) {
                    $subProgram = [
                        'program_wakaf_id' => $programWakaf->id,
                        'judul' => $subProgramData['judul'],
                        'deskripsi' => $subProgramData['deskripsi']
                    ];
                    
                    // Handle foto if exists
                    if (isset($subProgramData['foto']) && $subProgramData['foto'] instanceof \Illuminate\Http\UploadedFile) {
                        $foto = $subProgramData['foto'];
                        $namaFoto = 'sub_program_' . time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                        $foto->storeAs('public/program/wakaf/sub', $namaFoto);
                        $subProgram['foto'] = $namaFoto;
                    }
                    
                    \App\Models\SubProgramWakaf::create($subProgram);
                }
            }
        }
        
        return redirect()->route('admin.wakaf.index')
            ->with('success', 'Data program wakaf berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programWakaf = ProgramWakaf::findOrFail($id);
        return view('admin.program.wakaf.show', compact('programWakaf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programWakaf = ProgramWakaf::findOrFail($id);
        return view('admin.program.wakaf.edit', compact('programWakaf'));
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
            'deskripsi' => 'required|string',
        ]);
        
        $programWakaf = ProgramWakaf::findOrFail($id);
        $programWakaf->update([
            'deskripsi' => $request->deskripsi
        ]);
        
        return redirect()->route('admin.wakaf.index')
            ->with('success', 'Data program wakaf berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programWakaf = ProgramWakaf::findOrFail($id);
        
        // Delete foto files
        for ($i = 1; $i <= 3; $i++) {
            $field = 'foto'.$i;
            if ($programWakaf->$field) {
                Storage::delete('public/program/wakaf/' . $programWakaf->$field);
            }
        }
        
        $programWakaf->delete();
        
        return redirect()->route('admin.wakaf.index')
            ->with('success', 'Data program wakaf berhasil dihapus');
    }
}