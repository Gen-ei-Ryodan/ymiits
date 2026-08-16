<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    private function normalizeText($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $decoded = str_replace(["\r\n", "\r"], "\n", $decoded);

        $decoded = preg_replace('/�([^�]+)�/u', '"$1"', $decoded);
        $decoded = preg_replace('/([[:alnum:]])�([[:alnum:]])/u', "$1'$2", $decoded);

        $decoded = str_replace(
            ['â€œ', 'â€�', 'â€', 'â€', 'â€˜', 'â€™', 'â€’', 'â€“', 'â€”', 'Â'],
            ['"', '"', '"', '"', "'", "'", '-', '-', '-', ''],
            $decoded
        );

        $replacements = [
            "\u{00A0}" => ' ',
            "\u{201C}" => '"',
            "\u{201D}" => '"',
            "\u{201E}" => '"',
            "\u{00AB}" => '"',
            "\u{00BB}" => '"',
            "\u{2018}" => "'",
            "\u{2019}" => "'",
            "\u{201A}" => "'",
            "\u{2013}" => '-',
            "\u{2014}" => '-',
        ];

        return strtr($decoded, $replacements);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        News::create([
            'title' => $this->normalizeText($request->title),
            'content' => $this->normalizeText($request->content),
            'author' => $this->normalizeText($request->author),
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $this->normalizeText($request->title),
            'content' => $this->normalizeText($request->content),
            'author' => $this->normalizeText($request->author),
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        // Hapus gambar dari storage
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
