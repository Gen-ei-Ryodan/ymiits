@extends('layouts.guest')

@section('title', 'Galeri')

@section('content')
    {{-- Hero --}}
    <div class="relative h-[40vh] w-full overflow-hidden">
        <img src="{{ asset('img/border/header galeri.jpg') }}"
            alt="Yayasan Manarul Ilmi ITS Background"
            class="absolute inset-0 w-full h-full object-cover filter brightness-50" />
        <div class="relative mt-5 z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4 drop-shadow-lg">
                Galeri <span class="text-green-500 ml-3">YMI</span>
            </h1>
            <p class="text-xl md:text-2xl mb-5 text-white max-w-3xl mx-auto leading-relaxed drop-shadow-md">
                Dokumentasi Perjalanan Pemberdayaan dan Kepedulian Yayasan Manarul Ilmi ITS
            </p>
            <div class="h-1 w-32 bg-green-500 rounded-full"></div>
        </div>
    </div>

    {{-- Galeri Cards --}}
    <section class="min-h-screen bg-gradient-to-b from-green-50 to-white py-16" data-aos="fade-up">
        <div class="container mx-auto px-4 pb-16 max-w-7xl">
            {{-- Filter dan Pencarian --}}
            <div class="mb-12 flex flex-col md:flex-row justify-between items-center gap-4">
                <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-images text-green-600 mr-2"></i>
                    <span>Koleksi Galeri</span>
                </h2>
                <div class="relative">
                    <input type="text" placeholder="Cari galeri..." id="search-galeri"
                        class="pl-10 pr-4 py-2 rounded-full border-2 border-green-200 focus:border-green-500 focus:outline-none w-full md:w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500"></i>
                </div>
            </div>

            {{-- Gallery Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($galleries as $galeri)
                <a href="#" class="group relative overflow-hidden rounded-xl shadow-lg transform transition-all duration-500 hover:scale-105 hover:shadow-2xl w-full block">
                    <div class="relative">
                        <img src="{{ Storage::url($galeri->image) }}" alt="{{ $galeri->title }}"
                            class="w-full h-[350px] object-cover transition-transform duration-500 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $galeri->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 bg-gradient-to-t from-green-800/80 to-transparent">
                        <h3 class="text-2xl font-bold mb-2 text-white">{{ $galeri->title }}</h3>
                        <p class="text-green-100 italic">{{ Str::limit($galeri->description, 120) }}</p>
                    </div>
                </a>
                @empty
                <div class="col-span-full py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fas fa-image text-green-200 text-6xl mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-500 mb-2">Belum Ada Galeri</h3>
                        <p class="text-gray-400">Galeri sedang dalam proses pengembangan.</p>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                {{ $galleries->links() }}
            </div>

            <style>
                  /* Styling untuk pagination */
        .pagination {
            display: flex;
            list-style-type: none;
            margin: 20px 0;
            padding: 0;
            justify-content: center;
        }

        .pagination li {
            display: inline-block;
            margin: 0 2px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination li.active span {
            background-color: #3490dc;
            color: white;
            border-color: #3490dc;
        }

        .pagination li.disabled span {
            color: #aaa;
            cursor: not-allowed;
        }

        .pagination li a:hover {
            background-color: #f8f8f8;
            border-color: #bbb;
        }
            </style>
        </div>
        
        <div class="container mx-auto px-4 mt-8">
            <div class="h-px bg-gradient-to-r from-transparent via-green-400 to-transparent"></div>
        </div>
    </section>

    {{-- Modal Detail Galeri (opsional) --}}
    <div id="galleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="min-h-screen px-4 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-75 transition-opacity" id="modalOverlay"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-4xl w-full relative z-10">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="aspect-w-16 aspect-h-9 mb-4">
                        <img src="" id="modalImage" class="object-contain w-full" alt="Detail galeri">
                    </div>
                    <h3 class="text-2xl font-bold mb-2" id="modalTitle"></h3>
                    <p class="text-gray-600 mb-4" id="modalDescription"></p>
                    <div class="text-sm text-gray-500">
                        <i class="far fa-calendar-alt mr-1"></i> <span id="modalDate"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pencarian galeri
        const searchInput = document.getElementById('search-galeri');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const galleryItems = document.querySelectorAll('.grid > a');
                
                galleryItems.forEach(item => {
                    const title = item.querySelector('h3').innerText.toLowerCase();
                    const description = item.querySelector('p').innerText.toLowerCase();
                    
                    if (title.includes(searchTerm) || description.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
        
       
        const galleryItems = document.querySelectorAll('.grid > a');
        const modal = document.getElementById('galleryModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModal = document.getElementById('closeModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const modalDate = document.getElementById('modalDate');
        
        galleryItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                const imgSrc = item.querySelector('img').src;
                const title = item.querySelector('h3').innerText;
                const description = item.querySelector('p').innerText;
                const date = item.querySelector('.absolute.top-4').innerText;
                
                modalImage.src = imgSrc;
                modalTitle.innerText = title;
                modalDescription.innerText = description;
                modalDate.innerText = date;
                
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
        });
        
        if (closeModal) {
            closeModal.addEventListener('click', closeGalleryModal);
        }
        
        if (modalOverlay) {
            modalOverlay.addEventListener('click', closeGalleryModal);
        }
        
        function closeGalleryModal() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
    });
</script>
@endpush