@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Detail Berita</div>
        <a href="{{ route('admin.news.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="news-detail">
            <div class="news-image-section">
                <div class="news-image-container">
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="news-image">
                </div>
            </div>
            
            <div class="news-info-section">
                <div class="info-group">
                    <h5 class="info-title">Judul</h5>
                    <div class="info-content">{{ $news->title }}</div>
                </div>
                
                <div class="info-group">
                    <h5 class="info-title">Penulis</h5>
                    <div class="info-content">{{ $news->author }}</div>
                </div>
                
                <div class="info-group">
                    <h5 class="info-title">Tanggal Dibuat</h5>
                    <div class="info-content">
                        <i class="fas fa-calendar-alt"></i> {{ $news->created_at->format('d F Y, H:i') }}
                    </div>
                </div>
                
                <div class="info-group">
                    <h5 class="info-title">Terakhir Diperbarui</h5>
                    <div class="info-content">
                        <i class="fas fa-edit"></i> {{ $news->updated_at->format('d F Y, H:i') }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="news-content-section">
            <h5 class="section-title">Isi Berita</h5>
            <div class="news-content">
                {!! $news->content !!}
            </div>
        </div>
    </div>
    <div class="card-footer d-flex">
        <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus berita ini?')) document.getElementById('delete-form').submit()">
            <i class="fas fa-trash"></i> Hapus
        </button>
        <form id="delete-form" action="{{ route('admin.news.destroy', $news) }}" method="POST" style="display: none;">
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

/* News detail layout */
.news-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    margin-bottom: 2rem;
}

.news-image-section {
    flex: 1;
    min-width: 300px;
}

.news-info-section {
    flex: 1;
    min-width: 300px;
}

.news-image-container {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1rem;
    text-align: center;
    border: 1px solid var(--border);
}

.news-image {
    max-width: 100%;
    max-height: 400px;
    border-radius: 0.25rem;
}

/* Info groups */
.info-group {
    margin-bottom: 1.5rem;
}

.info-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.info-content {
    font-size: 1.1rem;
    color: var(--text-dark);
}

.info-content i {
    margin-right: 0.5rem;
    color: var(--text-light);
}

/* News content section */
.news-content-section {
    margin-top: 1rem;
    border-top: 1px solid var(--border);
    padding-top: 1.5rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 1rem;
}

.news-content {
    background-color: var(--light);
    padding: 1.5rem;
    border-radius: 0.5rem;
    border: 1px solid var(--border);
    line-height: 1.6;
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
    .news-detail {
        flex-direction: column;
    }
    
    .news-image-section,
    .news-info-section {
        width: 100%;
    }
}
</style>
@endsection