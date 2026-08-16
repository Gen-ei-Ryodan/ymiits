@extends('layouts.app')

@section('title', 'Tambah Galeri')

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center py-3">
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h5 class="card-title m-0">Tambah Galeri Baru</h5>
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

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text mt-1">
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Ukuran maksimum: 2MB</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5">
                    <div class="card border" id="preview-container" style="display: none;">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 small">Preview Gambar</h6>
                        </div>
                        <div class="card-body text-center p-3">
                            <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 250px;">
                        </div>
                    </div>
                    
                    <div class="text-center mt-3 p-4 border rounded bg-light" id="no-preview">
                        <i class="fas fa-cloud-upload-alt mb-2" style="font-size: 2rem; color: #6c757d;"></i>
                        <p class="mb-0 small text-muted">Unggah gambar untuk melihat preview</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
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
        const noPreview = document.getElementById('no-preview');
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                noPreview.style.display = 'none';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
            noPreview.style.display = 'block';
        }
    });
</script>
@endpush