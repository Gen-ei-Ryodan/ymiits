@extends('layouts.guest')
@section('title', $fromApi ? $news['title'] : $news->title)

@section('content')
<div class="pt-24 pb-12 bg-gradient-to-b from-green-50 via-green-100 to-green-200">
    <!-- Hero Section -->
    <div class="max-w-5xl mx-auto px-4" data-aos="fade-up">
        <!-- News Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-800">
                {{ $fromApi ? $news['title'] : $news->title }}
            </h1>
            <div class="mt-4 flex items-center justify-center text-gray-600 space-x-4">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="font-medium">
                        {{ $fromApi ? ($news['created_by'] ?? 'Admin YMI') : ($news->author ?? 'Admin YMI') }}
                    </span>
                </div>
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>
                        {{ $fromApi ? \Carbon\Carbon::parse($news['date'])->format('d F Y') : $news->created_at->format('d F Y') }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="px-3 py-1 text-xs rounded-full {{ $fromApi ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                        {{ $fromApi ? 'External Source' : 'YMI Source' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="mt-8 overflow-hidden rounded-xl shadow-lg" data-aos="zoom-in">
            <img src="{{ $fromApi 
                ? $news['thumbnail'] 
                : ($news->image ? Storage::url($news->image) : asset('img/default.jpg')) }}"
                alt="{{ $fromApi ? $news['title'] : $news->title }}"
                class="w-full h-auto object-cover" />
        </div>

        <!-- Content -->
        <div class="mt-12 bg-white rounded-xl shadow-md p-6 md:p-8 text-gray-700 leading-relaxed" data-aos="fade-up">
            <div class="prose prose-lg max-w-none">
               {!! $fromApi ? $news['body'] : nl2br(htmlspecialchars($news->content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) !!}
            </div>

          
        </div>
    </div>
</div>

<!-- Gallery Section -->
<section class="py-16 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-green-800 mb-2">Galeri Terbaru</h2>
        <p class="text-center text-gray-600 mb-10 max-w-2xl mx-auto">
            Dokumentasi dari kegiatan-kegiatan terbaru Yayasan Manarul Ilmi
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="100">
            @foreach($latestGalleries as $gallery)
                <div class="group overflow-hidden rounded-xl shadow-lg bg-white h-80 transition-all duration-300 hover:shadow-xl">
                    <img src="{{ Storage::url($gallery->image) }}"
                         alt="{{ $gallery->title }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 text-white">
                            <h3 class="font-bold text-lg">{{ $gallery->title }}</h3>
                            <p class="text-sm opacity-80">{{ $gallery->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Action Buttons -->
<section class="flex flex-col sm:flex-row justify-center items-center gap-4 py-10 px-4 bg-gradient-to-t from-green-50 to-white">
    <a href="{{ url('/news') }}"
        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full shadow-md transition flex items-center">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke News
    </a>
    <a href="https://www.itsedekah.id/" target="_blank"
        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full shadow-md transition flex items-center">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        Donasi Sekarang
    </a>
</section>
@endsection
