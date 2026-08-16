<header class="fixed top-0 left-0 w-full z-50 bg-white/70 backdrop-blur-md shadow-sm transition-all duration-300" id="mainHeader">
    <div class="max-w-7xl mx-auto px-4 md:px-8 flex justify-between items-center h-16 md:h-20">
       <a href="{{ url('/') }}" class="flex items-center gap-2">
    <img src="{{ asset('images/logo.png') }}" 
         alt="logo" 
         class="h-8 md:h-10 w-auto object-contain">
    
    <span class="text-xl md:text-2xl font-bold text-green-700">
        Yayasan Manarul <span class="text-green-400">Ilmi ITS</span>
    </span>
</a>
        {{-- Desktop Nav --}}
        <nav class="hidden md:flex space-x-6 font-semibold text-gray-800 items-center">
            <a href="{{ url('/') }}" class="hover:text-green-500">Home</a>
            <a href="{{ url('/homeprofile') }}" class="hover:text-green-500">Profile</a>
            {{-- Dropdown - Fixed dengan class dropdown-menu --}}
            <div class="relative group">
                <button class="flex items-center gap-1 hover:text-green-500">
                    Programs
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="dropdown-menu absolute top-full left-0 mt-2 min-w-[200px] bg-white shadow-xl rounded-lg z-[9999] invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300">
                    <div class="py-2">
                        <a href="{{ route('programs.keagamaan') }}"
                            class="block px-4 py-2 hover:bg-green-100">Keagamaan</a>
                        <a href="{{ route('programs.sosialkeumatan') }}"
                            class="block px-4 py-2 hover:bg-green-100">Sosial Keumatan</a>
                        <a href="{{ route('programs.pendidikan') }}"
                            class="block px-4 py-2 hover:bg-green-100">Pendidikan</a>
                        <a href="{{ route('programs.kemanusiaan') }}"
                            class="block px-4 py-2 hover:bg-green-100">Kemanusiaan</a>
                        <a href="{{ route('programs.wakaf') }}" class="block px-4 py-2 hover:bg-green-100">Wakaf</a>
                    </div>
                </div>
            </div>
            <a href="{{ url('/galeri') }}" class="hover:text-green-500">Galeri</a>
            <a href="{{ url('/news') }}" class="hover:text-green-500">News</a>
        </nav>
        {{-- Mobile Menu Button --}}
        <button id="mobileMenuBtn" class="block md:hidden text-green-600 p-2">
            <svg id="menuIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</header>