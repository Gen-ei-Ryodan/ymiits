<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $bannersQuery = HomeBanner::query();
        if (Schema::hasColumn('home_banners', 'urutan')) {
            $bannersQuery->orderByRaw('CASE WHEN urutan IS NULL OR urutan < 1 THEN 999999 ELSE urutan END ASC')
                ->orderByDesc('id');
        } else {
            $bannersQuery->latest();
        }
        $banners = $bannersQuery->get();

        return view('admin.home.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.home.banner.create');
    }

   public function store(Request $request)
{
    $rules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'gambar' => 'required|image|max:2048',
    ];
    if (Schema::hasColumn('home_banners', 'urutan')) {
        $rules['urutan'] = 'nullable|integer|min:1';
    }
    if (Schema::hasColumn('home_banners', 'status')) {
        $rules['status'] = 'nullable|in:active,inactive';
    }
    $validated = $request->validate($rules);

    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('banner_images', 'public');
    }

    if (Schema::hasColumn('home_banners', 'urutan')) {
        $validated['urutan'] = max(1, (int) $request->input('urutan', 1));
    }
    if (Schema::hasColumn('home_banners', 'status')) {
        $validated['status'] = $request->input('status', 'active');
    }

    HomeBanner::create($validated);

    return redirect()->route('admin.home-banner.index')
        ->with('success', 'Banner berhasil ditambahkan.');
}
    public function show(HomeBanner $homeBanner)
    {
        return view('admin.home.banner.show', compact('homeBanner'));
    }

    public function edit(HomeBanner $homeBanner)
    {
        return view('admin.home.banner.edit', compact('homeBanner'));
    }

   public function update(Request $request, HomeBanner $homeBanner)
{
    $rules = [
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|max:2048',
    ];
    if (Schema::hasColumn('home_banners', 'urutan')) {
        $rules['urutan'] = 'nullable|integer|min:1';
    }
    if (Schema::hasColumn('home_banners', 'status')) {
        $rules['status'] = 'nullable|in:active,inactive';
    }
    $validated = $request->validate($rules);

    if ($request->hasFile('gambar')) {
        if ($homeBanner->gambar) {
            Storage::disk('public')->delete($homeBanner->gambar);
        }

        $validated['gambar'] = $request->file('gambar')->store('banner_images', 'public');
    }

    if (Schema::hasColumn('home_banners', 'urutan')) {
        $validated['urutan'] = max(1, (int) $request->input('urutan', 1));
    }
    if (Schema::hasColumn('home_banners', 'status')) {
        $validated['status'] = $request->input('status', 'active');
    }

    $homeBanner->update($validated);

    return redirect()->route('admin.home-banner.index')
        ->with('success', 'Banner berhasil diperbarui.');
}

    public function destroy(HomeBanner $homeBanner)
    {
        if ($homeBanner->gambar) {
            Storage::disk('public')->delete($homeBanner->gambar);
        }

        $homeBanner->delete();

        return redirect()->route('admin.home-banner.index')->with('success', 'Banner berhasil dihapus.');
    }
}
