@extends('layouts.app')

@section('title', 'Program Wakaf')

@section('content')
<div class="container-fluid p-4">
    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col-md-12 px-3">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0 text-dark">
                    <i class="fas fa-donate me-2 text-primary"></i>Program Wakaf
                </h3>
                @if (!$programWakaf)
                    <a href="{{ route('admin.wakaf.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Tambah Program
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Alerts -->
    <div class="row">
        <div class="col-md-12 px-3">
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
        </div>
    </div>

    <!-- Program Description Card -->
    <div class="row mb-4">
        <div class="col-md-12 px-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold">
                        <i class="fas fa-info-circle me-2"></i>Deskripsi Program
                    </h5>
                    @if ($programWakaf)
                        <a href="{{ route('admin.wakaf.edit', $programWakaf->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit Deskripsi
                        </a>
                    @endif
                </div>

                <div class="card-body p-4">
                    @if ($programWakaf)
                        <div class="bg-light p-4 rounded border">
                            <p class="mb-0">{{ $programWakaf->deskripsi }}</p>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-info-circle text-muted fa-3x"></i>
                            </div>
                            <p class="text-muted mb-3">Deskripsi program belum diisi.</p>
                            <a href="{{ route('admin.wakaf.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Deskripsi Program
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($programWakaf)
        <!-- Sub Program Section -->
        <div class="row mb-3">
            <div class="col-md-12 px-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-layer-group text-primary me-2"></i>Sub Program
                    </h4>
                    <button type="button" class="btn btn-primary" onclick="toggleAddForm()">
                        <i class="fas fa-plus me-1"></i> Tambah Sub Program
                    </button>
                </div>
                <hr class="my-3">
            </div>
        </div>

        <!-- Add Sub Program Form (Hidden by default) -->
        <div class="row mb-4" id="addSubProgramForm" style="display: none;">
            <div class="col-md-12 px-3">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="m-0 font-weight-bold">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Sub Program Baru
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.wakaf.sub.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="program_wakaf_id" value="{{ $programWakaf->id }}">
                            
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="judul" class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                                    <input type="text" name="judul" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="deskripsi" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="foto" class="form-label fw-bold">Foto (Opsional)</label>
                                    <input type="file" name="foto" class="form-control">
                                    <small class="text-muted mt-1 d-block">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2" onclick="toggleAddForm()">
                                        <i class="fas fa-times me-1"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sub Program Cards -->
        @if ($subPrograms && $subPrograms->count() > 0)
            <div class="row">
                @foreach ($subPrograms as $sub)
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 mx-3">
                            <div class="card-header bg-secondary py-3">
                                <h5 class="card-title text-dark m-0 font-weight-bold">{{ $sub->judul }}</h5>
                            </div>
                            
                            <div class="card-body p-0">
                                @if ($sub->foto)
                                    <div class="text-center p-3">
                                        <img src="{{ asset('storage/program/wakaf/sub/' . $sub->foto) }}"
                                            class="img-fluid" style="max-height: 250px; object-fit: cover;"
                                            alt="Foto {{ $sub->judul }}">
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <p class="card-text">{{ $sub->deskripsi }}</p>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent d-flex justify-content-end p-3">
                                <form action="{{ route('admin.wakaf.sub.destroy', $sub->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Yakin ingin menghapus sub program ini?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-md-12 px-3">
                    <div class="card mb-4">
                        <div class="card-body text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-folder-open text-muted fa-4x"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada sub program ditambahkan.</h5>
                            <button type="button" class="btn btn-primary btn-lg" onclick="toggleAddForm()">
                                <i class="fas fa-plus me-2"></i> Tambah Sub Program Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>

<style>
    /* Basic Card Styling */
    .card {
        border-radius: 6px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 1rem;
    }
    
    .card-header {
        font-weight: 600;
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: rgba(0, 0, 0, 0.03);
        border-top: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    /* Card border color */
    .border-primary {
        border: 1px solid #4e73df !important;
    }
    
    /* Colors */
    .bg-primary {
        background-color: #4e73df !important;
    }
    
    .bg-secondary {
        background-color: #f8f9fa !important;
    }
    
    .bg-warning {
        background-color: #f6c23e !important;
    }
    
    /* Fixes for admin panel */
    .container-fluid {
        margin-left: auto;
        margin-right: auto;
        max-width: 1400px;
    }
    
    .p-4 {
        padding: 1.5rem !important;
    }
    
    .px-3 {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    
    .py-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }
    
    .me-1 {
        margin-right: 0.25rem !important;
    }
    
    .me-2 {
        margin-right: 0.5rem !important;
    }
    
    .mb-0 {
        margin-bottom: 0 !important;
    }
    
    .mb-3 {
        margin-bottom: 1rem !important;
    }
    
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    
    .my-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }
    
    .mt-1 {
        margin-top: 0.25rem !important;
    }
    
    .fw-bold {
        font-weight: 700 !important;
    }
    
    .font-weight-bold {
        font-weight: 700 !important;
    }
    
    .text-white {
        color: #fff !important;
    }
    
    .text-dark {
        color: #5a5c69 !important;
    }
    
    .text-primary {
        color: #4e73df !important;
    }
    
    .text-muted {
        color: #858796 !important;
    }
    
    .text-center {
        text-align: center !important;
    }
    
    .d-flex {
        display: flex !important;
    }
    
    .d-block {
        display: block !important;
    }
    
    .justify-content-between {
        justify-content: space-between !important;
    }
    
    .justify-content-end {
        justify-content: flex-end !important;
    }
    
    .align-items-center {
        align-items: center !important;
    }
    
    .form-label {
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    
    .rounded {
        border-radius: 0.25rem !important;
    }
    
    .border {
        border: 1px solid #e3e6f0 !important;
    }
    
    .fa-3x {
        font-size: 3em;
    }
    
    .fa-4x {
        font-size: 4em;
    }
</style>

<script>
    function toggleAddForm() {
        const form = document.getElementById('addSubProgramForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endsection