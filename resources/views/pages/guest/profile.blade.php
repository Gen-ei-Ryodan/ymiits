@extends('layouts.guest')

@section('title', 'Profile')

@section('content')
    {{-- Hero Section --}}
    <div class="h-[40vh] relative" id="profile-hero">
        <img src="img/border/header profile.jpg" alt="" class="absolute inset-0 object-cover h-full w-full">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-50"></div>
    </div>

    {{-- Visi Misi --}}
    <section class="py-16 px-10 max-w-7xl mx-auto" data-aos="fade-up" id="about-ymi">
        <h1 class="text-5xl md:text-7xl font-bold text-black mb-8">
            Yayasan <br> Manarul <span class="text-green-600 relative">Ilmi</span> <span class="text-green-600 relative">ITS</span>
             </h1>
        <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-12">
            Yayasan Manarul Ilmi ITS (YMI ITS) didirikan pada tahun 2019 oleh rektor Institut Teknologi Sepuluh Nopember (ITS) pada masa periodenya untuk mengelola dana zakat, infaq, sedekah, wakaf (ZISWAF) fokusnya pada kegiatan keagamaan, sosial, pendidikan, keutamaan wakaf). Sejak berdiri, YMI ITS berkomitmen untuk mengelola dana secara profesional dan memberikan manfaat bagi ITS dan masyarakat. Laporan ini, kami akan menyoroti perjalanan, pencapaian, dan dampak positif selama enam tahun terakhir.        </p>
        <div class="grid md:grid-cols-2 gap-6" data-aos="fade-up" id="visi-misi">
            <div class="bg-white border border-amber-100 p-6 rounded-xl shadow-lg group">
                <h3 class="text-2xl font-bold text-amber-600 mb-4">Visi</h3>
                <p class="text-gray-700">
                    Menjadi lembaga yang mampu memberikan manfaat besar bagi ITS dan masyarakat dengan pengelolaan yang terpercaya dan profesional
                </p>
            </div>
            <div class="bg-white border border-green-100 p-6 rounded-xl shadow-lg group">
                <h3 class="text-2xl font-bold text-green-600 mb-4">Misi</h3>
                <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                    <li>Menjalankan program-program penyaluran dan pemberdayaan untuk memperbanyak penerima manfaat</li>
                    <li>Menghimpun dan melakukan penyaluran dana umat secara amanah, efektif, dan efisien</li>
                    <li>Mengelola aset dengan konservatif dan piawai</li>
                </ol>
            </div>
        </div>
    </section>

    {{-- Foto Pendiri --}}
    <section class="py-12" data-aos="fade-up" id="pendiri">
        <div class="max-w-7xl mx-auto px-6">
            <div class="overflow-hidden rounded-xl shadow-lg h-[450px] mx-auto flex items-center justify-center">
                @if($fotoPendiri->isNotEmpty())
                    <img src="{{ asset('storage/' . $fotoPendiri->first()->foto) }}" alt="Pendiri Yayasan Manarul Ilmi ITS" class="w-full h-full object-cover object-top"">
                @else
                    <img src="img/profile/pendiri pembina ymi its.png" alt="Yayasan Manarul Ilmi ITS" class="w-full h-full object-cover object-top"">
                @endif
            </div>
        </div>
    </section>

    {{-- Struktur Organisasi --}}
    <section class="bg-gradient-to-b from-amber-50 to-white py-16 px-6" id="struktur-organisasi">
        <div class="max-w-7xl mx-auto text-center mb-12">
            <h2 class="text-4xl md:text-6xl font-bold text-black">Struktur <span class="text-green-600">Organisasi</span></h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6" data-aos="fade-left">
            {{-- Pendiri --}}
            <div class="bg-blue-50 p-6 rounded-xl shadow-md" id="pendiri-pembina">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Pendiri dan Pembina YMI ITS</h3>
                <ul class="space-y-2 text-sm text-gray-600 max-h-64 overflow-y-auto">
                    @forelse($pendiriPembina as $item)
                        <li>{{ $item->name }} {{ $item->position }}</li>
                    @empty
                        <li>Belum ada data</li>
                    @endforelse
                </ul>
            </div>
            {{-- Pengawas --}}
            <div class="bg-green-50 p-6 rounded-xl shadow-md" data-aos="fade-up" id="dewan-pengawas">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Pengawas YMI ITS 2025-2030</h3>
                <ul class="space-y-2 text-sm text-gray-600 max-h-64 overflow-y-auto">
                    @forelse($dewanYayasan as $item)
                        <li>{{ $item->position }}: {{ $item->name }}</li>
                    @empty
                        <li>Belum ada data</li>
                    @endforelse
                </ul>
            </div>
            {{-- Pengurus --}}
            <div class="bg-amber-50 p-6 rounded-xl shadow-md" data-aos="fade-right" id="pengurus-yayasan">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Pengurus YMI ITS 2025-2030</h3>
                <ul class="space-y-2 text-sm text-gray-600 max-h-64 overflow-y-auto">
                    @forelse($pengurus as $item)
                        <li>{{ $item->position }}: {{ $item->name }}</li>
                    @empty
                        <li>Belum ada data</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>

{{-- Donatur & Galeri --}}
<section class="bg-gray-100 py-16 px-4" data-aos="fade-up" id="donatur">
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        @php
            $donatur = \App\Models\Donatur::first();
        @endphp
        
        @if($donatur && $donatur->foto1)
        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-4 border-green-500">
            <img src="{{ Storage::url('donatur/'.$donatur->foto1) }}" alt="Donatur 1" class="w-full h-full object-cover">
        </div>
        @else
        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-4 border-green-500 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">Foto 1</span>
        </div>
        @endif
        
        @if($donatur && $donatur->foto2)
        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-4 border-green-500">
            <img src="{{ Storage::url('donatur/'.$donatur->foto2) }}" alt="Donatur 2" class="w-full h-full object-cover">
        </div>
        @else
        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-4 border-green-500 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">Foto 2</span>
        </div>
        @endif
        
        @if($donatur && $donatur->foto3)
        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-4 border-green-500">
            <img src="{{ Storage::url('donatur/'.$donatur->foto3) }}" alt="Donatur 3" class="w-full h-full object-cover">
        </div>
        @else
        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-4 border-green-500 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">Foto 3</span>
        </div>
        @endif
    </div>
    <div class="max-w-4xl mx-auto text-center mt-8">
        <h2 class="text-3xl font-bold text-green-700 mb-2">Donatur</h2>
        <p class="text-gray-600">Supporting in Semeru</p>
        <p class="text-2xl font-bold text-gray-800 mt-2">
            <span id="counter-donatur">0</span> Donatur
        </p>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi counter
        const counterDonatur = document.getElementById('counter-donatur');
        const targetValue = {{ $donatur ? $donatur->angka_donatur : 0 }};
        let currentCount = 0;
        const duration = 2000; // Durasi animasi dalam milidetik
        const frameRate = 30; // Berapa kali update per detik
        const increment = Math.ceil(targetValue / (duration / 1000 * frameRate));
        
        function updateCounter() {
            if (currentCount < targetValue) {
                // Tambahkan nilai random kecil untuk efek lebih dinamis
                currentCount += increment + Math.floor(Math.random() * 10);
                
                // Pastikan tidak melebihi nilai target
                if (currentCount > targetValue) {
                    currentCount = targetValue;
                }
                
                // Update tampilan dengan format angka
                counterDonatur.textContent = currentCount.toLocaleString('id-ID');
                
                // Lanjutkan animasi jika belum mencapai target
                if (currentCount < targetValue) {
                    setTimeout(updateCounter, 1000 / frameRate);
                }
            }
        }
        
        // Mulai animasi saat elemen masuk viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(counterDonatur);
    });
</script>
@endpush

   {{-- Penerima Manfaat --}}
<section class="py-10 bg-gray-50" data-aos="fade-up" id="penerima-manfaat">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php
                $penerimaManfaat = \App\Models\PenerimaManfaat::first();
            @endphp
            
            @if($penerimaManfaat)
                @for($i = 1; $i <= 6; $i++)
                    @php $field = 'foto'.$i; @endphp
                    @if($penerimaManfaat->$field)
                        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-2 border-green-500">
                            <img src="{{ Storage::url('penerima-manfaat/'.$penerimaManfaat->$field) }}" alt="Penerima Manfaat {{ $i }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-2 border-green-500 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Foto {{ $i }}</span>
                        </div>
                    @endif
                @endfor
            @else
                @for($i = 1; $i <= 6; $i++)
                    <div class="aspect-[4/3] overflow-hidden rounded-lg shadow-md border-2 border-green-500 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Foto {{ $i }}</span>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</section>

<section class="bg-white py-16 px-4" data-aos="fade-up" id="testimoni">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4">Testimoni</h2>
        <div id="testimonial-content" class="bg-green-50 rounded-xl p-6 shadow-md mb-6">
            <h3 class="text-xl font-semibold" id="reviewer-job"></h3>
            <p class="text-gray-700 mt-2 italic" id="review-content"></p>
            <p class="text-gray-900 font-bold mt-4" id="reviewer-name"></p>
        </div>
        <div class="flex justify-center space-x-2 testimonial-indicator" id="dots-container">
            <!-- Dots will be generated dynamically -->
        </div>
    </div>
</section>

    {{-- Lokasi --}}
   <section class="bg-white py-12 px-4" id="lokasi">
    <div class="max-w-xl mx-auto shadow-lg rounded-xl overflow-hidden">
        <div class="relative h-52 md:h-64">
            <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.634174213933!2d112.78818298518199!3d-7.282398452795471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa153fffffff%3A0xaed5a59d3dc817f9!2sMasjid%20Manarul%20Ilmi%20ITS!5e0!3m2!1sid!2sus!4v1743745878258!5m2!1sid!2sus" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Lokasi Kantor YMI</h3>
            <p class="text-gray-600">Kompleks Masjid Manarul Ilmi ITS, Surabaya</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch testimonials from database
        @php
            $testimonis = \App\Models\Testimoni::where('is_active', true)
                            ->orderBy('urutan', 'asc')
                            ->get();
            $testimoniArray = [];
            
            foreach($testimonis as $testimoni) {
                $testimoniArray[] = [
                    'name' => $testimoni->nama_pemberi,
                    'job' => $testimoni->judul,
                    'content' => $testimoni->isi
                ];
            }
        @endphp
        
        const reviews = @json($testimoniArray);
        
        // If no testimonials in DB, use defaults
        if (reviews.length === 0) {
            reviews.push({
                name: "Contoh Nama",
                job: "Contoh Jabatan/Posisi",
                content: "Contoh isi testimoni akan ditampilkan di sini. Silahkan tambahkan testimoni melalui panel admin."
            });
        }
        
        let currentReview = 0;
        
        // Create dot indicators
        const dotsContainer = document.getElementById('dots-container');
        for (let i = 0; i < reviews.length; i++) {
            const dot = document.createElement('div');
            dot.id = `dot-${i}`;
            dot.className = `h-2 ${i === 0 ? 'w-6 bg-green-500' : 'w-2 bg-gray-300'} rounded-full`;
            dotsContainer.appendChild(dot);
        }
        
        // Set initial content
        updateTestimonial(0);
        
        // Set interval for rotation
        setInterval(() => {
            currentReview = (currentReview + 1) % reviews.length;
            updateTestimonial(currentReview);
        }, 5000); // Change every 5 seconds
        
        function updateTestimonial(index) {
            document.getElementById('reviewer-name').textContent = reviews[index].name;
            document.getElementById('reviewer-job').textContent = reviews[index].job;
            document.getElementById('review-content').textContent = `"${reviews[index].content}"`;
            
            // Update dots
            for (let i = 0; i < reviews.length; i++) {
                document.getElementById(`dot-${i}`).className = `h-2 ${i === index ? 'w-6 bg-green-500' : 'w-2 bg-gray-300'} rounded-full transition-all duration-300`;
            }
        }
    });
</script>
@endpush