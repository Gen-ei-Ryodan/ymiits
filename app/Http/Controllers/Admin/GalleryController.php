<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the galleries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galeri.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified gallery.
     *
     * @param  \App\Models\Gallery  $galeri
     * @return \Illuminate\View\View
     */
    public function show(Gallery $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified gallery.
     *
     * @param  \App\Models\Gallery  $galeri
     * @return \Illuminate\View\View
     */
    public function edit(Gallery $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $galeri
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Gallery $galeri)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
                Storage::disk('public')->delete($galeri->image);
            }

            $imagePath = $request->file('image')->store('galleries', 'public');
            $data['image'] = $imagePath;
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified gallery from storage.
     *
     * @param  \App\Models\Gallery  $galeri
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Gallery $galeri)
    {
        if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus!');
    }
}
