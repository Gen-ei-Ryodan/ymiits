@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Foto Pendiri</h3>
                <a href="{{ route('admin.foto-pendiri.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.foto-pendiri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto" class="form-label">Foto Pendiri <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto" required>
                                <small class="text-muted">Format: JPG, PNG. Ukuran maksimal: 2MB.</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Preview</label>
                                <div class="preview-container border rounded p-3 d-flex justify-content-center align-items-center"
                                    style="min-height: 250px; background-color: var(--light);">
                                    <div id="preview-placeholder" class="text-center">
                                        <i class="fas fa-image fa-3x mb-2" style="color: var(--text-light);"></i>
                                        <p>Preview akan muncul di sini</p>
                                    </div>
                                    <img id="image-preview" style="max-width: 100%; max-height: 250px; display: none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-2">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
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
