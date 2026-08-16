@extends('layouts.guest')

@section('title', 'Program Keagamaan')

@section('content')
<section class="bg-gradient-to-b from-green-50 via-green-100 to-green-200 text-black">
    <div class="container mx-auto px-4 md:px-16 py-8 md:py-16" data-aos="fade-up">
        <div class="mb-12 md:mb-20 text-center pt-10">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4 md:mb-6">
                Program <span class="text-green-600">Keagamaan</span>
            </h1>
            <p class="max-w-3xl mx-auto text-base md:text-xl text-gray-600 leading-relaxed">
                {{ $programKeagamaan->deskripsi ?? 'Deskripsi belum tersedia.' }}
            </p>
        </div>

        @if($programKeagamaan->subPrograms->count() > 0)
            @foreach($programKeagamaan->subPrograms as $index => $subProgram)
                <div class="flex flex-col md:flex-{{ $index % 2 == 0 ? 'row' : 'row-reverse' }} items-center justify-between py-8 md:py-16 md:space-x-{{ $index % 2 == 0 ? '' : 'reverse ' }}md:space-x-12"
                     data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        @if ($subProgram->foto)
                            <img src="{{ asset('storage/program/keagamaan/sub/' . $subProgram->foto) }}" alt="{{ $subProgram->judul }}"
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
            @if($programKeagamaan)
                {{-- Sub Program 1 --}}
                <div class="flex flex-col md:flex-row items-center justify-between py-8 md:py-16 md:space-x-12"
                    data-aos="fade-right">
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        @if ($programKeagamaan->foto1)
                            <img src="{{ asset('storage/program/keagamaan/' . $programKeagamaan->foto1) }}" alt="{{ $programKeagamaan->sub_program1_judul }}"
                                class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                        @else
                            <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center rounded-xl">
                                <span class="text-gray-500">Foto belum tersedia</span>
                            </div>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 space-y-4 md:space-y-6 text-center md:text-right">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-4">{{ $programKeagamaan->sub_program1_judul }}</h2>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                            {{ $programKeagamaan->sub_program1_deskripsi }}
                        </p>
                        <div class="text-right">
                            <a href="https://www.itsedekah.id/"
                                class="inline-block mt-4 px-6 md:px-8 py-2 md:py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 text-center">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sub Program 2 --}}
                @if($programKeagamaan->sub_program2_judul)
                <div class="flex flex-col md:flex-row-reverse items-center justify-between py-8 md:py-16 md:space-x-reverse md:space-x-12"
                    data-aos="fade-left">
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        @if ($programKeagamaan->foto2)
                            <img src="{{ asset('storage/program/keagamaan/' . $programKeagamaan->foto2) }}" alt="{{ $programKeagamaan->sub_program2_judul }}"
                                class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                        @else
                            <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center rounded-xl">
                                <span class="text-gray-500">Foto belum tersedia</span>
                            </div>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 space-y-4 md:space-y-6 text-center md:text-left">
                        <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-4">{{ $programKeagamaan->sub_program2_judul }}</h2>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                            {{ $programKeagamaan->sub_program2_deskripsi }}
                        </p>
                        <div class="text-left">
                            <a href="https://www.itsedekah.id/"
                                class="inline-block mt-4 px-6 md:px-8 py-2 md:py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 text-center">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Subprogram 3 dan seterusnya (jika ada) --}}
                @for($i = 3; $i <= 8; $i++)
                    @php 
                        $judulField = 'sub_program'.$i.'_judul';
                        $deskripsiField = 'sub_program'.$i.'_deskripsi';
                        $fotoField = 'foto'.$i;
                        $isEven = $i % 2 == 0;
                    @endphp
                    
                    @if($programKeagamaan->$judulField)
                        <div class="flex flex-col md:flex-{{ $isEven ? 'row-reverse' : 'row' }} items-center justify-between py-8 md:py-16 md:space-x-{{ $isEven ? 'reverse ' : '' }}md:space-x-12"
                            data-aos="{{ $isEven ? 'fade-left' : 'fade-right' }}">
                            <div class="w-full md:w-1/2 mb-6 md:mb-0">
                                @if ($programKeagamaan->$fotoField)
                                    <img src="{{ asset('storage/program/keagamaan/' . $programKeagamaan->$fotoField) }}" 
                                        alt="{{ $programKeagamaan->$judulField }}"
                                        class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                                @else
                                    <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center rounded-xl">
                                        <span class="text-gray-500">Foto belum tersedia</span>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full md:w-1/2 space-y-4 md:space-y-6 text-center md:text-{{ $isEven ? 'left' : 'right' }}">
                                <h2 class="text-2xl md:text-3xl font-bold text-green-800 mb-4">{{ $programKeagamaan->$judulField }}</h2>
                                <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                                    {{ $programKeagamaan->$deskripsiField }}
                                </p>
                                <div class="text-{{ $isEven ? 'left' : 'right' }}">
                                    <a href="https://www.itsedekah.id/"
                                        class="inline-block mt-4 px-6 md:px-8 py-2 md:py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 text-center">
                                        Donasi Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
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