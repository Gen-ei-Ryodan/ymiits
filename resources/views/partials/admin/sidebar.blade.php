<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-layer-group"></i>
            <span>CMS ADMIN</span>
        </div>
    </div>
    <div class="sidebar-menu">
        <div class="menu-category">Main</div>
        <a href="/admin" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-category">
            Home
        </div>
        <a href="{{ route('admin.homeangka.index') }}"
            class="menu-item {{ request()->routeIs('admin.homeangka.*') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home Penerima Manfaat</span>
        </a>

        <a href="{{ route('admin.home-banner.index') }}"
            class="menu-item {{ request()->routeIs('admin.home-banner.*') ? 'active' : '' }}">
            <i class="fas fa-image"></i>
            <span>Home Banner</span>
        </a>


        <div class="menu-category">
            Profile
        </div>

        <a href="{{ route('admin.pendiri-pembina.index') }}"
            class="menu-item {{ request()->routeIs('admin.pendiri-pembina.*') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i>
            <span>Pendiri/Pembina</span>
        </a>

        <a href="{{ route('admin.foto-pendiri.index') }}"
            class="menu-item {{ request()->routeIs('admin.foto-pendiri.*') ? 'active' : '' }}">
            <i class="fas fa-image"></i>
            <span>Foto Pendiri</span>
        </a>

        <a href="{{ route('admin.dewan-yayasan.index') }}"
            class="menu-item {{ request()->routeIs('admin.dewan-yayasan.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Dewan Yayasan</span>
        </a>

        <a href="{{ route('admin.pengurus.index') }}"
            class="menu-item {{ request()->routeIs('admin.pengurus.*') ? 'active' : '' }}">
            <i class="fas fa-user-friends"></i>
            <span>Pengurus</span>
        </a>
        <a href="{{ route('admin.donatur.index') }}"
            class="menu-item {{ request()->routeIs('admin.donatur.*') ? 'active' : '' }}">
            <i class="fas fa-hand-holding-heart"></i>
            <span>Donatur</span>
        </a>

        <a href="{{ route('admin.penerima-manfaat.index') }}"
            class="menu-item {{ request()->routeIs('admin.penerima-manfaat.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Penerima Manfaat</span>
        </a>

        <a href="{{ route('admin.testimoni.index') }}"
            class="menu-item {{ request()->routeIs('admin.testimoni.*') ? 'active' : '' }}">
            <i class="fas fa-comment-dots"></i>
            <span>Testimoni</span>
        </a>

        <div class="menu-category">Program</div>
        <a href="{{ route('admin.keagamaan.index') }}"
            class="menu-item {{ request()->routeIs('keagamaan.*') ? 'active' : '' }}">
            <i class="fas fa-pray"></i>
            <span>Program Keagamaan</span>
        </a>
        <a href="{{ route('admin.sosial-keumatan.index') }}"
            class="menu-item {{ request()->routeIs('sosial-keumatan.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Program Sosial Keumatan</span>
        </a>
        <a href="{{ route('admin.sosial-pendidikan.index') }}"
            class="menu-item {{ request()->routeIs('sosial-pendidikan.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i>
            <span>Program Pendidikan</span>
        </a>
        <a href="{{ route('admin.kemanusiaan.index') }}"
            class="menu-item {{ request()->routeIs('kemanusiaan.*') ? 'active' : '' }}">
            <i class="fas fa-hand-holding-heart"></i>
            <span>Program Kemanusiaan</span>
        </a>
        <a href="{{ route('admin.wakaf.index') }}"
            class="menu-item {{ request()->routeIs('wakaf.*') ? 'active' : '' }}">
            <i class="fas fa-donate"></i>
            <span>Program Wakaf</span>
        </a>
        <div class="menu-category">Galeri</div>

        <a href="{{ route('admin.galeri.index') }}"
            class="menu-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
            <i class="fas fa-image"></i>
            <span>Galeri</span>
        </a>
        <div class="menu-category">News</div>

        <a href="{{ route('admin.news.index') }}"
            class="menu-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i>
            <span>Berita</span>
        </a>



        <div class="menu-category">Settings</div>

        <form action="{{ route('logout') }}" method="POST" class="menu-item-form">
            @csrf
            <button type="submit" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</div>
