<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use App\Models\News;
use App\Models\PendiriPembina;
use App\Models\DewanYayasan;
use App\Models\Pengurus;
use App\Models\Donatur;
use App\Models\PenerimaManfaat;
use App\Models\ProgramKeagamaan;
use App\Models\ProgramKemanusiaan;
use App\Models\ProgramSosialKeumatan;
use App\Models\ProgramSosialPendidikan;
use App\Models\ProgramWakaf;
use App\Models\Home;
use App\Models\HomeBanner;
use App\Services\NewsApiService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    protected $newsApiService;

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

    public function __construct(NewsApiService $newsApiService)
    {
        $this->newsApiService = $newsApiService;
    }

    public function home()
    {
        // Get news from database
        $internalNews = News::latest()->take(3)->get()->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $this->normalizeText($item->title),
                'body' => $this->normalizeText($item->content),
                'content' => $this->normalizeText($item->content),
                'thumbnail' => $item->image ? Storage::url($item->image) : asset('img/default.jpg'),
                'author' => $this->normalizeText($item->author),
                'date' => $item->created_at->format('Y-m-d H:i:s'),
                'source' => 'internal'
            ];
        })->toArray();

        // Get news from API (limit to 3 for homepage)
        $externalNews = array_slice($this->newsApiService->getAllNews(), 0, 3);

        // Combine and get the latest 3
        $combinedNews = array_merge($internalNews, $externalNews);
        $combinedNews = array_map(function ($item) {
            if (isset($item['title'])) {
                $item['title'] = $this->normalizeText($item['title']);
            }
            return $item;
        }, $combinedNews);
        // Sort by date descending (newest first)
        usort($combinedNews, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        $news = array_slice($combinedNews, 0, 3);

        $homeData = Home::first(); // Get all home data at once
        $jumlahPenerima = $homeData?->jumlah_penerima_manfaat ?? 0;
        $foto1 = $homeData?->foto_1 ?? null;
        $foto2 = $homeData?->foto_2 ?? null;
        $bannersQuery = HomeBanner::query();
        if (Schema::hasColumn('home_banners', 'status')) {
            $bannersQuery->where('status', 'active');
        }
        if (Schema::hasColumn('home_banners', 'urutan')) {
            $bannersQuery->orderByRaw('CASE WHEN urutan IS NULL OR urutan < 1 THEN 999999 ELSE urutan END ASC')
                ->orderByDesc('id');
        } else {
            $bannersQuery->latest();
        }
        $banners = $bannersQuery->get();
        return view('home', compact('news', 'jumlahPenerima', 'banners', 'foto1', 'foto2'));
    }

    public function profile()
    {
        $pendiriPembina = PendiriPembina::all();
        $dewanYayasan = DewanYayasan::all();
        $pengurus = Pengurus::all();
        $donatur = Donatur::first();
        $penerimaManfaat = PenerimaManfaat::first();
        $fotoPendiri = \App\Models\FotoPendiri::all();
        
        return view('pages.guest.profile', compact('pendiriPembina', 'dewanYayasan', 'pengurus', 'donatur', 'penerimaManfaat', 'fotoPendiri'));
    }

    public function galeri()
    {
        $galleries = \App\Models\Gallery::latest()->paginate(9);
        return view('pages.guest.galeri', compact('galleries'));
        
    }

    public function news()
    {
        // Get news from database
        $internalNews = News::latest()->get()->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'body' => $item->content,
                'content' => $item->content,
                'thumbnail' => $item->image ? Storage::url($item->image) : asset('img/default.jpg'),
                'author' => $item->author,
                'date' => $item->created_at->format('Y-m-d H:i:s'),
                'source' => 'internal'
            ];
        })->toArray();

        // Get news from API
        $externalNews = $this->newsApiService->getAllNews();

        // Combine both sources
        $news = array_merge($internalNews, $externalNews);
        
        // Sort by date descending (newest first)
        usort($news, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('pages.guest.news', compact('news'));
    }

    public function showNews($id)
    {
        // Check if it's an external news (IDs from external API are numeric)
        if (is_numeric($id)) {
            // Try to get from external API
            $news = $this->newsApiService->getNewsById($id);
            
            if ($news) {
                // Get some latest galleries for the bottom section
                $latestGalleries = Gallery::latest()->take(3)->get();
                
                return view('pages.guest.detail-news', [
                    'news' => $news,
                    'fromApi' => true,
                    'latestGalleries' => $latestGalleries
                ]);
            }
        }
        
        // If not found in external API or ID is not numeric, try internal database
        $news = News::find($id);
        
        if ($news) {
            // Get some latest galleries for the bottom section
            $latestGalleries = Gallery::latest()->take(3)->get();
            
            return view('pages.guest.detail-news', [
                'news' => $news,
                'fromApi' => false,
                'latestGalleries' => $latestGalleries
            ]);
        }
        
        // If not found in either source, return 404
        abort(404);
    }

    public function keagamaan()
    {
        $programKeagamaan = ProgramKeagamaan::with('subPrograms')->first();
        return view('pages.guest.programs.keagamaan', compact('programKeagamaan'));
    }
    public function sosialkeumatan()
    {
        $programSosialKeumatan = ProgramSosialKeumatan::with('subPrograms')->first();
        return view('pages.guest.programs.sosialkeumatan', compact('programSosialKeumatan'));
    }
    
    public function pendidikan()
    {
        $programSosialPendidikan = ProgramSosialPendidikan::with('subPrograms')->first();
        return view('pages.guest.programs.pendidikan', compact('programSosialPendidikan'));
    }
    
    public function kemanusiaan()
    {
        $programKemanusiaan = ProgramKemanusiaan::with('subPrograms')->first();
        return view('pages.guest.programs.kemanusiaan', compact('programKemanusiaan'));
    }
    
    public function wakaf()
    {
        $programWakaf = ProgramWakaf::with('subPrograms')->first();
        return view('pages.guest.programs.wakaf', compact('programWakaf'));
    }
    
    public function programs()
    {
        // Fetch all program data
        $programKeagamaan = ProgramKeagamaan::with('subPrograms')->first();
        $programSosialKeumatan = ProgramSosialKeumatan::with('subPrograms')->first();
        $programSosialPendidikan = ProgramSosialPendidikan::with('subPrograms')->first();
        $programKemanusiaan = ProgramKemanusiaan::with('subPrograms')->first();
        $programWakaf = ProgramWakaf::with('subPrograms')->first();
        
        return view('pages.guest.programs', compact(
            'programKeagamaan',
            'programSosialKeumatan',
            'programSosialPendidikan',
            'programKemanusiaan',
            'programWakaf'
        ));
    }
}
