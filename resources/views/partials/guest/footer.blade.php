<footer class="w-full bg-green-900 py-8 md:py-12 text-white">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">

        {{-- Desktop View --}}
        <div class="hidden md:flex flex-col lg:flex-row items-start justify-between">
            {{-- Logo and Description --}}
            <div class="lg:w-1/3 mb-8 lg:mb-0">
                <h2 class="text-3xl font-bold">
                    Yayasan Manarul <span class="text-green-400">Ilmi ITS</span>
                </h2>
                <p class="mt-4 text-sm lg:text-base text-white/80 max-w-md">
                    Mengabadikan Amal Anda
                </p>
                <p class="mt-4 text-sm lg:text-base text-white/80 max-w-md">
                    Masjid Manarul Ilmi, lt 2 serambi selatan, Kompleks
                    <br>Kampus ITS, Keputih, Sukolilo, Surabaya
                    <br>Telepon : 081938811003
                </p>
            </div>

            {{-- Navigation --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                {{-- About Us --}}
               <div class="flex flex-col space-y-3">
    <h3 class="text-xl font-bold mb-2">About Us</h3>
    <a href="{{ url('/homeprofile#about-ymi') }}" class="hover:text-amber-200 transition-colors">Tentang YMI</a>
    <a href="{{ url('/homeprofile#visi-misi') }}" class="hover:text-amber-200 transition-colors">Visi & Misi</a>
    <a href="{{ url('/homeprofile#struktur-organisasi') }}" class="hover:text-amber-200 transition-colors">Struktur Organisasi</a>
    <a href="{{ url('/homeprofile#donatur') }}" class="hover:text-amber-200 transition-colors">Donatur</a>
    <a href="{{ url('/homeprofile#testimoni') }}" class="hover:text-amber-200 transition-colors">Testimoni</a>
</div>

                {{-- Support --}}
               <div class="flex flex-col space-y-3">
    <h3 class="text-xl font-bold mb-2">Program</h3>
    <a href="{{ route('programs.keagamaan') }}" class="hover:text-amber-200 transition-colors">Keagamaan</a>
    <a href="{{ route('programs.sosialkeumatan') }}" class="hover:text-amber-200 transition-colors">Sosial Keumatan</a>
    <a href="{{ route('programs.pendidikan') }}" class="hover:text-amber-200 transition-colors">Pendidikan</a>
    <a href="{{ route('programs.kemanusiaan') }}" class="hover:text-amber-200 transition-colors">Kemanusiaan</a>
    <a href="{{ route('programs.wakaf') }}" class="hover:text-amber-200 transition-colors">Wakaf</a>
</div>

                {{-- Social --}}
                {{-- Social --}}
                <div class="flex flex-col space-y-6">
                    <div>
                        <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            {{-- WhatsApp --}}
                            <a href="https://wa.me/+6281938811003" target="_blank"
                                class="w-10 h-10 bg-white/20 rounded-full hover:bg-white/30 flex items-center justify-center text-[#25D366] text-xl">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                            {{-- Instagram --}}
                            <a href="https://www.instagram.com/yayasanmanarulilmiits" target="_blank"
                                class="w-10 h-10 bg-white/20 rounded-full hover:bg-white/30 flex items-center justify-center text-[#E1306C] text-xl">
                                <i class="fab fa-instagram"></i>
                            </a>

                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/yayasanmanarulilmiits" target="_blank"
                                class="w-10 h-10 bg-white/20 rounded-full hover:bg-white/30 flex items-center justify-center text-[#1877F2] text-xl">
                                <i class="fab fa-facebook"></i>
                            </a>

                            {{-- TikTok --}}
                            <a href="https://www.tiktok.com/@ymi_its" target="_blank"
                                class="w-10 h-10 bg-white/20 rounded-full hover:bg-white/30 flex items-center justify-center text-black text-xl">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Mobile View --}}
    <div class="md:hidden mt-8 space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold"> Yayasan Manarul <span class="text-green-400">Ilmi ITS</span></h2>
            <p class="mt-2 text-sm text-white/80">
                Mengabadikan amal anda dengan berbagi kebaikan untuk yang membutuhkan
            </p>
        </div>

        {{-- Navigation --}}
        <div class="grid grid-cols-2 gap-6 text-sm text-center">
            <div class="space-y-2">
                <h3 class="font-semibold text-white">About Us</h3>
                <a href="{{ url('/our-story') }}" class="block hover:text-amber-200">Our Story</a>
                <a href="{{ url('/why-manarulilmi') }}" class="block hover:text-amber-200">Why Manarul Ilmi?</a>
                <a href="{{ url('/testimonial') }}" class="block hover:text-amber-200">Testimonials</a>
            </div>
            <div class="space-y-2">
                <h3 class="font-semibold text-white">Support</h3>
                <a href="{{ url('/faq') }}" class="block hover:text-amber-200">FAQ</a>
                <a href="{{ url('/contact') }}" class="block hover:text-amber-200">Contact Us</a>
                <a href="{{ url('/help') }}" class="block hover:text-amber-200">Help Center</a>
            </div>
        </div>

        {{-- Social Media --}}
        <div class="text-center">
            <h3 class="font-semibold mb-2">Follow Us</h3>
            <div class="flex justify-center space-x-4 text-xl">
                <a href="https://wa.me/+6281938811003" target="_blank"
                    class="text-[#25D366] hover:scale-110 transition">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.instagram.com/yayasanmanarulilmiits" target="_blank"
                    class="text-[#E1306C] hover:scale-110 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/yayasanmanarulilmiits" target="_blank"
                    class="text-[#1877F2] hover:scale-110 transition">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.tiktok.com/@ymi_its" target="_blank" class="text-black hover:scale-110 transition">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="text-center text-white/80 text-sm border-t border-white/20 pt-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ url('/privacy') }}" class="hover:text-amber-200">Privacy Policy</a>
                <a href="{{ url('/terms') }}" class="hover:text-amber-200">Terms of Service</a>
                <a href="{{ url('/cookies') }}" class="hover:text-amber-200">Cookie Policy</a>
            </div>
        </div>
    </div>

</footer>
