@extends('layouts.guest')
@section('title', 'Wakaf')
@section('content')
<section class="bg-gradient-to-b from-green-50 via-green-100 to-green-200 text-black">
    <div class="container mx-auto px-4 md:px-16 py-8 md:py-16" data-aos="fade-up">
        <div class="mb-12 md:mb-20 text-center pt-10">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4 md:mb-6">
                Program <span class="text-green-600">Wakaf</span>
            </h1>
            <p class="max-w-3xl mx-auto text-base md:text-xl text-gray-600 leading-relaxed">
                {{ $programWakaf->deskripsi ?? 'Deskripsi belum tersedia.' }}
            </p>
        </div>

        @if($programWakaf->subPrograms->count() > 0)
            @foreach($programWakaf->subPrograms as $index => $subProgram)
                <div class="flex flex-col md:flex-{{ $index % 2 == 0 ? 'row' : 'row-reverse' }} items-center justify-between py-8 md:py-16 md:space-x-{{ $index % 2 == 0 ? '' : 'reverse ' }}md:space-x-12"
                     data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        @if ($subProgram->foto)
                            <img src="{{ asset('storage/program/wakaf/sub/' . $subProgram->foto) }}" alt="{{ $subProgram->judul }}"
                                 class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                        @else
                            <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center rounded-xl">
                                <span class="text-gray-500">Foto belum tersedia</span>
                            </div>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 space-y-4 md:space-y-6 text-center md:text-{{ $index % 2 == 0 ? 'right' : 'left' }}">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-4">{{ $subProgram->judul }}</h2>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                            {{ $subProgram->deskripsi }}
                        </p>
                        <div class="text-{{ $index % 2 == 0 ? 'right' : 'left' }}">
                            <a href="https://www.itsedekah.id/"
                               class="inline-block mt-4 px-6 md:px-8 py-2 md:py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 text-center">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            {{-- Fallback to old structure if no sub-programs exist --}}
            @if($programWakaf)
                <div class="space-y-16">
                    @for($i = 1; $i <= 3; $i++)
                        @php 
                            $judulField = 'sub_program'.$i.'_judul';
                            $deskripsiField = 'sub_program'.$i.'_deskripsi';
                            $fotoField = 'foto'.$i;
                            $isEven = $i % 2 == 0;
                        @endphp
                        @if($programWakaf->$judulField)
                        <div class="flex flex-col md:flex-row items-center md:space-x-12 md:py-8" data-aos="{{ $isEven ? 'fade-left' : 'fade-right' }}">
                            @if($programWakaf->$fotoField && !$isEven)
                            <div class="w-full md:w-1/2 mb-6 md:mb-0">
                                <img src="{{ asset('storage/program/wakaf/'.$programWakaf->$fotoField) }}" 
                                    alt="{{ $programWakaf->$judulField }}"
                                    class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg" />
                            </div>
                            @endif
                            <div class="w-full md:w-1/2 text-center md:text-{{ $isEven ? 'left' : 'right' }} space-y-4">
                                <h2 class="text-2xl md:text-3xl font-bold text-green-800">
                                    {{ $programWakaf->$judulField }}
                                </h2>
                                <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                                    {{ $programWakaf->$deskripsiField }}
                                </p>
                                <a href="https://www.itsedekah.id/"
                                    class="inline-block mt-2 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Donasi Sekarang</a>
                            </div>
                            @if($programWakaf->$fotoField && $isEven)
                            <div class="w-full md:w-1/2 mb-6 md:mb-0 md:order-last order-first">
                                <img src="{{ asset('storage/program/wakaf/'.$programWakaf->$fotoField) }}" 
                                    alt="{{ $programWakaf->$judulField }}"
                                    class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg" />
                            </div>
                            @endif
                        </div>
                        @endif
                    @endfor
                </div>
            @endif
        @endif

        {{-- Tombol Kembali --}}
        <div class="mt-8 md:mt-16 flex justify-center">
            <a href="{{ route('home') }}"
                class="group relative inline-flex items-center px-6 md:px-8 py-2 md:py-3 overflow-hidden bg-green-600 text-white rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mr-2 w-4 md:w-5 h-4 md:h-5 transition-transform duration-300 group-hover:-translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="relative z-10 text-base md:text-lg font-semibold">Kembali</span>
            </a>
        </div>
    </div>
</section>
@endsection