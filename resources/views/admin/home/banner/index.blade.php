@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h3 class="mb-1 text-dark">Home Banner</h3>
                <div class="text-muted">Kelola banner slider di halaman beranda</div>
            </div>
            <a href="{{ route('admin.home-banner.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Tambah Banner
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">No</th>
                                <th style="width: 110px;">Preview</th>
                                <th>Judul</th>
                                <th style="width: 140px;">Urutan</th>
                                <th style="width: 140px;">Status</th>
                                <th class="text-end" style="width: 220px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="banner-thumb-sm">
                                            <img src="{{ asset('storage/' . $banner->gambar) }}" alt="{{ $banner->judul }}">
                                        </div>
                                    </td>
                                    <td class="min-w-0">
                                        <div class="fw-semibold text-dark text-truncate" style="max-width: 520px;">
                                            {{ $banner->judul }}
                                        </div>
                                        <div class="text-muted small text-truncate" style="max-width: 520px;">
                                            {{ Str::limit($banner->deskripsi, 80) }}
                                        </div>
                                    </td>
                                    <td>
                                        @if (isset($banner->urutan) && (int) $banner->urutan >= 1)
                                            <span class="badge bg-secondary">#{{ (int) $banner->urutan }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($banner->status))
                                            <span class="badge {{ $banner->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $banner->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('admin.home-banner.show', $banner) }}" class="btn btn-sm btn-info text-white">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </a>
                                            <a href="{{ route('admin.home-banner.edit', $banner) }}" class="btn btn-sm btn-warning text-white">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.home-banner.destroy', $banner) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin mau hapus banner ini?')">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        Belum ada banner yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        .banner-thumb-sm {
            width: 96px;
            height: 54px;
            border-radius: 10px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .banner-thumb-sm img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
@endpush
