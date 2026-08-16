@extends('layouts.guest')

@section('title', 'News')

@section('content')
    {{-- Hero Section --}}
    <section class="relative h-[30vh] w-full overflow-hidden">
        <img src="{{ asset('img/border/header news.jpg') }}" alt="Yayasan Manarul Ilmi ITS Background"
            class="absolute inset-0 w-full h-full object-cover brightness-50">
        <div class="relative mt-5 z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
                News & <span class="text-green-500 ml-3">Article YMI</span>
            </h1>
            <div class="h-1 w-32 bg-green-500 rounded-full"></div>
        </div>
    </section>

    {{-- News List --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="relative">
                {{-- Tombol Navigasi --}}
                <button id="prevBtn"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-green-600 text-white px-4 py-2 rounded-full shadow z-10 hover:bg-green-700">
                    &#8592;
                </button>
                <button id="nextBtn"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-green-600 text-white px-4 py-2 rounded-full shadow z-10 hover:bg-green-700">
                    &#8594;
                </button>

                <div id="carousel" class="flex overflow-x-auto space-x-6 scroll-smooth snap-x snap-mandatory hide-scrollbar" data-aos="fade-up">
                    {{-- News Cards --}}
                    @foreach ($news as $item)
                        <div class="flex-shrink-0 w-80 snap-center border-2 border-green-600 rounded-xl overflow-hidden shadow-lg">
                            <a href="{{ url('/news/'.$item['id']) }}">
                                <img src="{{ $item['thumbnail'] ?? asset('img/default.jpg') }}" 
                                     class="w-full h-48 object-cover" 
                                     alt="{{ $item['title'] }}" />

                                <div class="p-4">
                                    <h3 class="text-xl font-semibold text-green-900 mb-2">{{ $item['title'] }}</h3>
                                    
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <span class="mr-3">
                                            <i class="fas fa-user mr-1"></i>
                                            {{ $item['source'] === 'external' ? ($item['created_by'] ?? 'Admin YMI') : $item['author'] }}
                                        </span>
                                        <span>
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($item['date'])->format('d M Y') }}
                                        </span>
                                        <span class="ml-auto px-2 py-1 text-xs rounded-full {{ $item['source'] === 'external' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $item['source'] === 'external' ? 'External' : 'Internal' }}
                                        </span>
                                    </div>

                                    <p class="text-green-700 text-sm mb-4">
                                        {{ Str::limit(strip_tags($item['source'] === 'external' 
                                            ? ($item['body'] ?? '-') 
                                            : ($item['content'] ?? '-')
                                        ), 100) }}
                                    </p>

                                    <span class="text-green-600 hover:text-green-800 text-sm inline-flex items-center">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Hide scrollbar but keep functionality */
    .hide-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    
    .hide-scrollbar::-webkit-scrollbar {
        display: none;  /* Chrome, Safari and Opera */
    }
</style>
@endpush

@push('scripts')
<script>
    // Add FontAwesome if it's not already included
    if (!document.querySelector('link[href*="font-awesome"]')) {
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
        document.head.appendChild(link);
    }

    // Carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('carousel');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const cardWidth = 320; // Width of a card + spacing
        let scrollAmount = cardWidth;
        let autoScrollInterval;

        // Function to scroll right
        const scrollRight = () => {
            // If at end, go back to start
            if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth - 10) {
                carousel.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        };

        // Function to scroll left
        const scrollLeft = () => {
            // If at start, go to end
            if (carousel.scrollLeft <= 10) {
                carousel.scrollTo({ left: carousel.scrollWidth, behavior: 'smooth' });
            } else {
                carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            }
        };

        // Button click handlers
        nextBtn.addEventListener('click', () => {
            scrollRight();
            // Reset auto-scroll timer
            clearInterval(autoScrollInterval);
            startAutoScroll();
        });

        prevBtn.addEventListener('click', () => {
            scrollLeft();
            // Reset auto-scroll timer
            clearInterval(autoScrollInterval);
            startAutoScroll();
        });

        // Auto scroll function
        const startAutoScroll = () => {
            autoScrollInterval = setInterval(scrollRight, 3000);
        };

        // Start auto-scrolling
        startAutoScroll();

        // Pause auto-scroll when hovering over carousel
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoScrollInterval);
        });

        // Resume auto-scroll when mouse leaves
        carousel.addEventListener('mouseleave', () => {
            startAutoScroll();
        });
    });
</script>
@endpush