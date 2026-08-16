@extends('layouts.app')

@section('title', 'Detail Galeri')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Detail Galeri</div>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="gallery-detail">
            <div class="gallery-image-section">
                <div class="gallery-image-container">
                    <img src="{{ Storage::url($galeri->image) }}" alt="{{ $galeri->title }}" class="gallery-image">
                </div>
                <div class="gallery-timestamp">
                    <i class="fas fa-clock"></i> {{ $galeri->created_at->diffForHumans() }}
                </div>
            </div>
            
            <div class="gallery-info-section">
                <div class="gallery-title">
                    <h4>{{ $galeri->title }}</h4>
                </div>
                
                <div class="gallery-description">
                    <p>{{ $galeri->description }}</p>
                </div>
                
                <div class="gallery-metadata">
                    <h5 class="section-title">Informasi Detail</h5>
                    <table class="detail-table">
                        <tr>
                            <th width="150"><i class="fas fa-calendar-plus"></i> Dibuat</th>
                            <td>{{ $galeri->created_at->format('d F Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-edit"></i> Diperbarui</th>
                            <td>{{ $galeri->updated_at->format('d F Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-image"></i> Nama File</th>
                            <td>{{ basename($galeri->image) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex">
        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form').submit()">
            <i class="fas fa-trash"></i> Hapus
        </button>
        <form id="delete-form" action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<style>
/* Memastikan class d-flex dan lainnya bekerja */
.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}

.me-2 {
    margin-right: 0.5rem;
}

/* Gallery detail layout */
.gallery-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
}

.gallery-image-section {
    flex: 1;
    min-width: 300px;
}

.gallery-info-section {
    flex: 2;
    min-width: 300px;
}

.gallery-image-container {
    margin-bottom: 1rem;
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1rem;
    text-align: center;
    border: 1px solid var(--border);
}

.gallery-image {
    max-width: 100%;
    max-height: 400px;
    border-radius: 0.25rem;
}

.gallery-timestamp {
    text-align: center;
    color: #6c757d;
    font-size: 0.9rem;
}

.gallery-timestamp i {
    margin-right: 0.5rem;
}

.gallery-title {
    border-bottom: 1px solid var(--border);
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}

.gallery-title h4 {
    margin: 0;
    color: var(--text-dark);
    font-weight: 600;
}

.gallery-description {
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.gallery-description p {
    margin: 0;
    color: var(--text-dark);
}

/* Detail table */
.gallery-metadata {
    margin-top: 1.5rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.detail-table {
    width: 100%;
    border-collapse: collapse;
}

.detail-table th, 
.detail-table td {
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
}

.detail-table th {
    background-color: var(--secondary);
    font-weight: 600;
    color: var(--text-dark);
}

.detail-table th i {
    margin-right: 0.5rem;
}

/* Button styles */
.btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--primary-hover);
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: var(--danger);
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gallery-detail {
        flex-direction: column;
    }
    
    .gallery-image-section,
    .gallery-info-section {
        width: 100%;
    }
}
</style>
@endsection