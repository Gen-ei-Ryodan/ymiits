@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Edit Berita</div>
        <a href="{{ route('admin.news.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="form-section">
                <h4 class="section-title">Informasi Berita</h4>
                
                <div class="form-group">
                    <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $news->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $news->author) }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-section">
                <h4 class="section-title">Konten Berita</h4>
                
                <div class="form-group">
                    <label for="content" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8" required>{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-section">
                <h4 class="section-title">Gambar Berita</h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div class="current-image">
                                <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="preview-img">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" class="form-label">Ganti Gambar</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="image" id="image" class="file-input @error('image') is-invalid @enderror" accept="image/*">
                                <label for="image" class="file-input-label">
                                    <span class="file-input-text">Pilih gambar baru</span>
                                    <span class="file-input-button">Browse</span>
                                </label>
                            </div>
                            @error('image')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Ukuran maksimum: 2MB</small>
                                <br>
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            </div>
                            
                            <div class="new-image-preview mt-3" id="preview-container" style="display: none;">
                                <label class="form-label">Preview Gambar Baru</label>
                                <div class="preview-image-container">
                                    <img id="preview-image" src="#" alt="Preview" class="preview-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
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

.mb-0 {
    margin-bottom: 0;
}

.mt-1 {
    margin-top: 0.25rem;
}

.mt-3 {
    margin-top: 1rem;
}

.ms-2 {
    margin-left: 0.5rem;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-6 {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

@media (min-width: 768px) {
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

/* Section styling */
.form-section {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.25rem;
}

/* Form styling */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: var(--primary);
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.25);
}

.is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #dc3545;
}

.text-danger {
    color: #dc3545 !important;
}

.text-muted {
    color: #6c757d !important;
}

.form-text {
    display: block;
    margin-top: 0.25rem;
    font-size: 80%;
}

/* Image styling */
.current-image, 
.preview-image-container {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 0.75rem;
    text-align: center;
    border: 1px solid var(--border);
    margin-bottom: 1rem;
}

.preview-img {
    max-width: 100%;
    max-height: 200px;
    border-radius: 0.25rem;
}

/* File input styling */
.file-input-wrapper {
    position: relative;
    width: 100%;
    margin-bottom: 0.5rem;
}

.file-input {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 10;
}

.file-input-label {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    cursor: pointer;
}

.file-input-text {
    flex-grow: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.file-input-button {
    padding: 0.375rem 0.75rem;
    margin-left: 0.5rem;
    background-color: var(--primary);
    color: white;
    border-radius: 0.25rem;
    transition: background-color 0.15s ease-in-out;
}

.file-input:hover ~ .file-input-label .file-input-button {
    background-color: var(--primary-hover);
}

/* Alert styling */
.alert {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
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

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}
</style>

@push('scripts')
<script>
    // Preview gambar sebelum diupload
    document.getElementById('image').addEventListener('change', function() {
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const file = this.files[0];
        const fileInputText = document.querySelector('.file-input-text');
        
        if (file) {
            // Update file input label
            fileInputText.textContent = file.name;
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            fileInputText.textContent = 'Pilih gambar baru';
            previewContainer.style.display = 'none';
        }
    });
    
    // Gunakan CKEDITOR untuk field content jika tersedia
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('content');
    }
</script>
@endpush
@endsection