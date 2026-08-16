@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h3 class="mb-1 text-dark">Detail Banner</h3>
                <div class="text-muted">Informasi banner untuk slider beranda</div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.home-banner.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <a href="{{ route('admin.home-banner.edit', $homeBanner) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-start gap-3">
                        <div class="min-w-0">
                            <div class="fw-semibold text-dark">{{ $homeBanner->judul }}</div>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @isset($homeBanner->urutan)
                                    <span class="badge bg-secondary">Urutan: {{ $homeBanner->urutan }}</span>
                                @endisset
                                @if (isset($homeBanner->status))
                                    <span class="badge {{ $homeBanner->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $homeBanner->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('admin.home-banner.destroy', $homeBanner) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin mau hapus banner ini?')">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="text-muted small mb-2">Deskripsi</div>
                        <div class="text-dark" style="white-space: pre-line;">
                            {{ $homeBanner->deskripsi ?: '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="fw-semibold text-dark">Gambar Banner</div>
                        <div class="text-muted small">Preview tampilan di beranda</div>
                    </div>
                    <div class="card-body">
                        <div class="banner-preview">
                            <img src="{{ asset('storage/' . $homeBanner->gambar) }}" alt="{{ $homeBanner->judul }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .banner-preview {
            border-radius: 12px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.06);
            aspect-ratio: 16 / 9;
        }

        .banner-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
@endpush
