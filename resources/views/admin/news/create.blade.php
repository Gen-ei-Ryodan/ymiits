@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Tambah Berita Baru</div>
    </div>
    <div class="card-body">
        <!-- Alert untuk error -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" required>
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="content" class="form-label">Isi Berita</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Ukuran maksimum: 2MB</small>
                </div>
                <div class="mt-3" id="preview-container" style="display: none;">
                    <img id="preview-image" src="#" alt="Preview" style="max-width: 300px; max-height: 200px;" class="img-thumbnail">
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview gambar sebelum diupload
    document.getElementById('image').addEventListener('change', function() {
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
    
    // Gunakan CKEDITOR untuk field content jika tersedia
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('content');
    }
</script>
@endpush