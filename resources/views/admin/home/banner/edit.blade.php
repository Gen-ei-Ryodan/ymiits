@extends('layouts.app')

@section('content')
    <div class="container-fluid p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h3 class="mb-1 text-dark">Edit Banner</h3>
                <div class="text-muted">Perbarui informasi banner untuk slider beranda</div>
            </div>
            <a href="{{ route('admin.home-banner.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.home-banner.update', $homeBanner) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-3">
                                <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul', $homeBanner->judul) }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $homeBanner->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="active" {{ old('status', $homeBanner->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $homeBanner->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="urutan" class="form-label">Urutan</label>
                                <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                                    id="urutan" name="urutan" value="{{ old('urutan', $homeBanner->urutan) }}"
                                    min="1">
                                <small class="text-muted">Mulai dari 1, semakin kecil angka semakin atas tampilnya</small>
                                @error('urutan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Gambar Saat Ini</label>
                                <div class="current-preview">
                                    <img src="{{ asset('storage/' . $homeBanner->gambar) }}" alt="{{ $homeBanner->judul }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="gambar" class="form-label">Ganti Gambar (Opsional)</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti gambar</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Preview Gambar Baru</label>
                                <div class="new-preview">
                                    <div id="preview-placeholder" class="text-center text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <div>Preview gambar baru akan muncul di sini</div>
                                    </div>
                                    <img id="image-preview">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <a href="{{ route('admin.home-banner.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>

                        <div class="d-flex gap-2">
                            <button type="reset" class="btn btn-warning text-white">
                                <i class="fas fa-redo me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Banner
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image preview functionality
            document.getElementById('gambar').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    const preview = document.getElementById('image-preview');
                    const placeholder = document.getElementById('preview-placeholder');

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                        placeholder.style.display = 'none';
                    }

                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection

@push('styles')
    <style>
        .current-preview,
        .new-preview {
            border-radius: 12px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.06);
            aspect-ratio: 16 / 9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .current-preview {
            padding: 0;
        }

        .current-preview img,
        #image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        #image-preview {
            display: none;
        }
    </style>
@endpush
