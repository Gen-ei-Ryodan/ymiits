<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('images/logogo.png') }}" type="image/png">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Loading Screen Styles */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader {
            display: inline-block;
            width: 80px;
            height: 80px;
            position: relative;
        }

        .loader:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid #16a34a; /* green-600 */
            border-color: #16a34a transparent #16a34a transparent;
            animation: loader 1.2s linear infinite;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .loading-logo {
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: bold;
        }

        .loading-progress {
            width: 250px;
            height: 5px;
            background-color: #e5e7eb; /* gray-200 */
            border-radius: 4px;
            margin-top: 20px;
            overflow: hidden;
        }

        .loading-progress-bar {
            height: 100%;
            background-color: #16a34a; /* green-600 */
            border-radius: 4px;
            width: 0;
            transition: width 0.3s ease;
        }

        .loading-text {
            margin-top: 10px;
            font-size: 14px;
            color: #4b5563; /* gray-600 */
        }

        /* Perbaikan CSS untuk mengatasi scrolling vertikal dan dropdown */
        html,
        body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
            position: relative;
        }

        body.menu-open {
            overflow: hidden;
        }

        /* Reset semua overflow pada header */
        #mainHeader {
            width: 100%;
            max-width: 100%;
            overflow: visible !important;
            height: auto;
            min-height: 4rem;
            display: block;
            position: fixed;
        }

        #mainHeader > div {
            overflow: visible !important;
        }

        /* Pastikan nav dan dropdown dapat terlihat di luar header */
        #mainHeader nav,
        #mainHeader .group {
            overflow: visible !important;
            position: relative;
        }

        /* Dropdown styling */
        .group .dropdown-menu {
            position: absolute !important;
            top: 100%;
            left: 0;
            z-index: 9999 !important;
        }

        /* Mobile menu styling */
        #mobileMenu {
            width: 16rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            right: auto;
            bottom: auto;
            z-index: 9999;
            overflow-y: auto;
            background: white;
            transition: transform 0.3s ease;
            transform: translateX(-100%);
        }

        #mobileMenu.translate-x-0 {
            transform: translateX(0);
        }

        /* Beri ruang untuk header fixed */
        main {
            padding-top: 5rem;
        }

        /* Pastikan semua container konten tidak memiliki overflow */
        .container,
        .max-w-7xl,
        main {
            overflow-x: visible !important;
        }
    </style>

    <title>@yield('title', 'Manarul Ilmi')</title>
</head>

<body class="bg-white text-gray-800 font-[Inter]">
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="loading-logo">
            <span class="text-green-700">Yayasan Manarul <span class="text-green-400">Ilmi ITS</span>
        </div>
        <div class="loader"></div>
        <div class="loading-progress">
            <div class="loading-progress-bar" id="progress-bar"></div>
        </div>
        <div class="loading-text" id="loading-text">Memuat Halaman...</div>
    </div>

    {{-- Header --}}
    @include('partials.guest.header')

    {{-- Mobile Menu --}}
    <div id="mobileMenu"
        class="fixed inset-0 w-64 h-screen bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-[9999] overflow-y-auto">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <span class="text-xl font-bold text-green-700">Manarul<span class="text-green-400">Ilmi</span></span>
            <button id="closeMenuBtn">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="p-4 flex flex-col space-y-2 font-medium text-gray-700">
            <a href="{{ url('/') }}" class="py-2 hover:text-green-600">Home</a>
            <a href="{{ url('/homeprofile') }}" class="py-2 hover:text-green-600">Profile</a>
            <a href="{{ route('programs.keagamaan') }}" class="py-2 hover:text-green-600">Keagamaan</a>
            <a href="{{ route('programs.sosialkeumatan') }}" class="py-2 hover:text-green-600">Sosial Keumatan</a>
            <a href="{{ route('programs.pendidikan') }}" class="py-2 hover:text-green-600">Pendidikan</a>
            <a href="{{ route('programs.kemanusiaan') }}" class="py-2 hover:text-green-600">Kemanusiaan</a>
            <a href="{{ route('programs.wakaf') }}" class="py-2 hover:text-green-600">Wakaf</a>
            <a href="{{ url('/galeri') }}" class="py-2 hover:text-green-600">Galeri</a>
            <a href="{{ url('/news') }}" class="py-2 hover:text-green-600">News</a>
        </nav>
    </div>

    {{-- Main Content --}}
    <main class="w-full">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.guest.footer')

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Loading Screen Script
        document.addEventListener('DOMContentLoaded', function() {
            const loadingScreen = document.getElementById('loading-screen');
            const progressBar = document.getElementById('progress-bar');
            const loadingText = document.getElementById('loading-text');
            
            // Update progress bar
            let progress = 0;
            let loadingInterval = setInterval(function() {
                if (progress < 70) {
                    progress += Math.random() * 10;
                    progressBar.style.width = Math.min(progress, 70) + '%';
                    loadingText.textContent = 'Memuat Halaman... ' + Math.floor(Math.min(progress, 70)) + '%';
                }
            }, 300);
            
            // Count all images and background images on the page
            const allImages = document.querySelectorAll('img');
            const totalImages = allImages.length;
            let loadedImages = 0;
            
            function imageLoaded() {
                loadedImages++;
                progress = 70 + (loadedImages / totalImages) * 30;
                progressBar.style.width = progress + '%';
                loadingText.textContent = 'Memuat Halaman... ' + Math.floor(progress) + '%';
                
                if (loadedImages >= totalImages) {
                    clearInterval(loadingInterval);
                    progressBar.style.width = '100%';
                    loadingText.textContent = 'Memuat Halaman... 100%';
                    
                    // Hide loading screen
                    setTimeout(function() {
                        loadingScreen.style.opacity = '0';
                        setTimeout(function() {
                            loadingScreen.style.visibility = 'hidden';
                            // Initialize AOS after loading is complete
                            AOS.init({
                                duration: 1000,
                                once: false
                            });
                        }, 500);
                    }, 500);
                }
            }
            
            // Check if all images are loaded
            if (totalImages === 0) {
                // If no images, simulate complete loading after 1.5 seconds
                setTimeout(function() {
                    clearInterval(loadingInterval);
                    progressBar.style.width = '100%';
                    loadingText.textContent = 'Memuat Halaman... 100%';
                    
                    setTimeout(function() {
                        loadingScreen.style.opacity = '0';
                        setTimeout(function() {
                            loadingScreen.style.visibility = 'hidden';
                            // Initialize AOS after loading is complete
                            AOS.init({
                                duration: 1000,
                                once: false
                            });
                        }, 500);
                    }, 500);
                }, 1500);
            } else {
                // Add load event listener to each image
                allImages.forEach(img => {
                    if (img.complete) {
                        imageLoaded();
                    } else {
                        img.addEventListener('load', imageLoaded);
                        img.addEventListener('error', imageLoaded); // Handle image load errors
                    }
                });
                
                // If images take too long to load, hide loading screen after 8 seconds
                setTimeout(function() {
                    clearInterval(loadingInterval);
                    loadingScreen.style.opacity = '0';
                    loadingScreen.style.visibility = 'hidden';
                    // Initialize AOS after loading is complete
                    AOS.init({
                        duration: 1000,
                        once: false
                    });
                }, 8000);
            }
        });

        document.getElementById("footerToggleBtn")?.addEventListener("click", function() {
            const menu = document.getElementById("footerMenu");
            const chevron = document.getElementById("footerChevron");
            menu.classList.toggle("hidden");
            chevron.classList.toggle("rotate-90");
        });

        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMenuBtn = document.getElementById('closeMenuBtn');
        const header = document.getElementById('mainHeader');

        // Menu mobile toggle
        mobileMenuBtn?.addEventListener('click', function() {
            mobileMenu.classList.remove('-translate-x-full');
            mobileMenu.classList.add('translate-x-0');
            document.body.classList.add('menu-open');
            mobileMenuBtn.classList.add('hidden');
        });

        closeMenuBtn?.addEventListener('click', function() {
            mobileMenu.classList.remove('translate-x-0');
            mobileMenu.classList.add('-translate-x-full');
            document.body.classList.remove('menu-open');
            mobileMenuBtn.classList.remove('hidden');
        });

        // Klik luar menu
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isClickOnToggle = mobileMenuBtn.contains(event.target);
            const isClickOnClose = closeMenuBtn.contains(event.target);

            if (!isClickInsideMenu && !isClickOnToggle && !isClickOnClose && !mobileMenu.classList.contains(
                    '-translate-x-full')) {
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('-translate-x-full');
                document.body.classList.remove('menu-open');
                mobileMenuBtn.classList.remove('hidden');
            }
        });

        // Scroll efek
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('bg-white', 'shadow-md');
                header.classList.remove('bg-white/30');
            } else {
                header.classList.remove('bg-white', 'shadow-md');
                header.classList.add('bg-white/30');
            }
        });
    </script>

    {{-- Stack untuk script tambahan per halaman --}}
    @stack('scripts')
</body>

</html>