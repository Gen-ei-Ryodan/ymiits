@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Foto Pendiri</h3>
                <a href="{{ route('admin.foto-pendiri.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <h5 class="mb-3">Foto Saat Ini</h5>
                    <div class="text-center p-3 border rounded" style="background-color: var(--light);">
                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Sekarang" class="img-thumbnail"
                            style="max-height: 250px;">
                    </div>
                </div>

                <form action="{{ route('admin.foto-pendiri.update', $foto->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto" class="form-label">Pilih Foto Baru</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Preview Foto Baru</label>
                                <div class="preview-container border rounded p-3 d-flex justify-content-center align-items-center"
                                    style="min-height: 250px; background-color: var(--light);">
                                    <div id="preview-placeholder" class="text-center">
                                        <i class="fas fa-image fa-3x mb-2" style="color: var(--text-light);"></i>
                                        <p>Preview foto baru akan muncul di sini</p>
                                    </div>
                                    <img id="image-preview" style="max-width: 100%; max-height: 250px; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.foto-pendiri.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image preview functionality
            document.getElementById('foto').addEventListener('change', function(e) {
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
