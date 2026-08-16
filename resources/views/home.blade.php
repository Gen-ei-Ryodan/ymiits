@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section --}}
    <section class="relative h-screen w-full overflow-hidden" id="hero-slider">
        <div class="absolute inset-0 z-0">
            <img id="hero-image" src="{{ !$banners->isEmpty() ? asset('storage/' . $banners[0]->gambar) : 'img/galeri/IMG_0675.JPG' }}" alt=""
                class="w-full h-full object-cover brightness-50 transition-all duration-700 ease-in-out" />
            <div class="absolute bottom-0 w-full h-[40%] bg-gradient-to-t from-white/50 via-transparent to-transparent"></div>
            <div class="absolute top-0 w-full h-[30%] bg-gradient-to-b from-white/50 via-transparent to-transparent"></div>
        </div>
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 z-10">
            <h3 id="hero-category"
                class="inline-block font-semibold mb-4 bg-green-500 text-white px-5 py-2 rounded-full shadow-md text-base">
                Program Kebaikan
            </h3>
            <h1 id="hero-title" class="text-4xl md:text-6xl font-bold text-white drop-shadow-md mb-4">
                {{ !$banners->isEmpty() ? $banners[0]->judul : 'Wakaf Pendidikan' }}
            </h1>
            <p id="hero-subtitle" class="text-white text-xl max-w-2xl mb-6 drop-shadow-md">
                {{ !$banners->isEmpty() ? $banners[0]->deskripsi : 'Berikan masa depan cerah bagi generasi penerus bangsa dengan investasi abadi untuk ilmu yang bermanfaat' }}
            </p>
            <a href="https://www.itsedekah.id/" target="_blank"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                Klik Disini!
            </a>
        </div>
        <div id="hero-indicators"
            class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex flex-row gap-2 z-20"></div>
        <button id="prev-btn"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-green-500 text-white p-2 rounded-full z-20">
            &#10094;
        </button>
        <button id="next-btn"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-green-500 text-white p-2 rounded-full z-20">
            &#10095;
        </button>
    </section>

    {{-- Sejarah Section --}}
    <section class="relative py-20 bg-gradient-to-b from-green-50 to-white overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 bg-gradient-to-br from-green-100 to-white opacity-60 animate-pulse"></div>
        <div
            class="relative max-w-4xl mx-auto px-4 py-10 bg-white border-4 border-green-500 rounded-2xl shadow-xl hover:shadow-2xl transform transition duration-500">
            <h2 class="text-5xl font-extrabold text-center text-gray-800 mb-6">Sejarah Pendirian YMI</h2>
            <p class="text-lg text-justify text-gray-700 leading-relaxed">
                Yayasan Manarul Ilmi ITS (YMI ITS) didirikan pada tahun 2019 oleh rektor Institut Teknologi Sepuluh Nopember (ITS) pada masa periodenya untuk mengelola dana zakat, infaq, sedekah, wakaf (ZISWAF) fokusnya pada kegiatan keagamaan, sosial, pendidikan, keutamaan wakaf). Sejak berdiri, YMI ITS berkomitmen untuk mengelola dana secara profesional dan memberikan manfaat bagi ITS dan masyarakat.
            </p>
        </div>
    </section>

    {{-- Statistik Section --}}
    <section class="bg-gradient-to-b from-white to-green-50 py-16">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 id="jumlahPenerima" class="text-5xl font-bold text-green-800">0</h2>
                <p class="text-2xl text-green-900">PENERIMA MANFAAT</p>
            </div>
            
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const countEl = document.getElementById("jumlahPenerima");
                    const target = {{ $jumlahPenerima }};
                    let countStarted = false;
            
                    const observer = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting && !countStarted) {
                                countStarted = true;
            
                                let count = 0;
                                const step = Math.ceil(target / 50);
                                const interval = setInterval(() => {
                                    count += Math.floor(Math.random() * step) + 1;
            
                                    if (count >= target) {
                                        count = target;
                                        clearInterval(interval);
                                    }
            
                                    countEl.textContent = count.toLocaleString("id-ID");
                                }, 20);
            
                                observer.unobserve(countEl); // stop observing once it's triggered
                            }
                        });
                    }, {
                        threshold: 0.6 // 60% dari elemen masuk viewport
                    });
            
                    observer.observe(countEl);
                });
            </script>
            
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative rounded-xl shadow-lg overflow-hidden group" data-aos="fade-left">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition-opacity duration-300"></div>
                    <img src="{{ $foto1 ? asset('storage/' . $foto1) : 'img/home/IMG_3500 2.JPG' }}" alt="Kegiatan" class="w-full h-64 object-cover" />
                </div>
                <div class="relative rounded-xl shadow-lg overflow-hidden group" data-aos="fade-right">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition-opacity duration-300"></div>
                    <img src="{{ $foto2 ? asset('storage/' . $foto2) : 'img/home/bar.png' }}" alt="Laporan" class="w-full h-64 object-cover" />
                </div>
            </div>
        </div>
    </section>

    {{-- Hot News Section --}}
    <section class="py-16 bg-gradient-to-b from-green-50 to-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-extrabold text-center mb-12 text-green-600">HOT NEWS YMI</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($news as $item)
                <div class="bg-white border-2 border-green-600 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    <a href="{{ url('/news/' . $item['id']) }}">
                        <div class="relative">
                            <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}"
                                 class="w-full h-48 object-cover" />
                            <div class="absolute inset-0 bg-green-900 opacity-30 hover:opacity-20 transition-opacity"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-green-900 mb-2">{{ $item['title'] }}</h3>
                            <p class="text-green-700 mb-4">
                                {{ Str::limit(strip_tags($item['source'] === 'external' ? $item['body'] : $item['content']), 100) }}
                            </p>
                            <span class="inline-flex items-center text-green-600 hover:text-green-800">
                                Baca Selengkapnya →
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-10">
            <a href="https://www.itsedekah.id/" target="_blank"
               class="px-8 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                Donasi Sekarang
            </a>
        </div>
    </div>
</section>

    
@endsection


@push('scripts')
    {{-- Script untuk hero slider --}}
    <script>
        const heroData = [
            @foreach($banners as $banner)
            {
                title: "{{ $banner->judul }}",
                subtitle: "{{ $banner->deskripsi }}",
                category: "Program Kebaikan",
                image: "{{ asset('storage/' . $banner->gambar) }}"
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ];

        // Fallback if no banners
        @if($banners->isEmpty())
        heroData.push({
            title: "Wakaf Pendidikan",
            subtitle: "Berikan masa depan cerah bagi generasi penerus bangsa dengan investasi abadi untuk ilmu yang bermanfaat",
            category: "Program Kebaikan",
            image: "img/home/WAKAF_PENDIDIKAN_LANDSACPE-WULAN.jpg"
        });
        @endif

        let currentIndex = 0;
        const imageEl = document.getElementById("hero-image");
        const titleEl = document.getElementById("hero-title");
        const subtitleEl = document.getElementById("hero-subtitle");
        const categoryEl = document.getElementById("hero-category");
        const indicatorsContainer = document.getElementById("hero-indicators");

        function updateSlide(index) {
            const { title, subtitle, category, image } = heroData[index];
            imageEl.classList.add("opacity-0");
            setTimeout(() => {
                imageEl.src = image;
                titleEl.textContent = title;
                subtitleEl.textContent = subtitle;
                categoryEl.textContent = category;
                imageEl.classList.remove("opacity-0");
            }, 300);

            document.querySelectorAll(".hero-indicator").forEach((dot, i) => {
                dot.classList.toggle("bg-green-500", i === index);
                dot.classList.toggle("bg-gray-300", i !== index);
            });
        }

        heroData.forEach((_, i) => {
            const dot = document.createElement("button");
            dot.className = "hero-indicator w-3 h-3 rounded-full transition-all duration-300 bg-gray-300";
            dot.addEventListener("click", () => {
                currentIndex = i;
                updateSlide(i);
            });
            indicatorsContainer.appendChild(dot);
        });

        document.getElementById("next-btn").addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % heroData.length;
            updateSlide(currentIndex);
        });

        document.getElementById("prev-btn").addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + heroData.length) % heroData.length;
            updateSlide(currentIndex);
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % heroData.length;
            updateSlide(currentIndex);
        }, 5000);

        updateSlide(currentIndex);
    </script>
@endpush
