@extends('layouts.app')

@section('title', 'Edit Program Wakaf')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Edit Program Wakaf</div>
            <a href="{{ route('admin.wakaf.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('admin.wakaf.update', $programWakaf->id) }}" method="POST" enctype="multipart/form-data">
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

                {{-- Deskripsi --}}
                <div class="form-section">
                    <h4 class="section-title">Informasi Umum</h4>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi Program <span
                                class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control @error('deskripsi') is-invalid @enderror"
                            required>{{ old('deskripsi', $programWakaf->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Deskripsi ini akan ditampilkan pada halaman program wakaf di
                            website.</small>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> 
                    Sub program dapat ditambahkan atau diubah pada halaman utama Program Wakaf.
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.wakaf.index') }}" class="btn btn-secondary ms-2">
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

        .me-2 {
            margin-right: 0.5rem;
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
            font-size: 1.25rem;
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
            font-size: 0.875rem;
        }

        /* Form Check */
        .form-check {
            display: block;
            min-height: 1.5rem;
            margin-bottom: 0.125rem;
        }

        .form-check-input {
            margin-right: 0.5rem;
        }

        .form-check-label {
            margin-bottom: 0;
            cursor: pointer;
        }

        /* Foto preview styling */
        .foto-preview {
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .foto-preview.empty {
            border: 1px dashed #dee2e6;
        }

        .preview-img {
            max-width: 100%;
            max-height: 200px;
            display: block;
            margin: 0 auto;
        }

        .foto-placeholder {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .foto-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #adb5bd;
        }

        .foto-placeholder p {
            margin: 0;
            color: #6c757d;
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

        .file-input:hover~.file-input-label .file-input-button {
            background-color: var(--primary-hover);
        }

        /* Alert styling */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
        }

        .alert-info {
            background-color: #e0f3ff;
            border: 1px solid #cce5ff;
            color: #0c5460;
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .col-md-4 {
            position: relative;
            width: 100%;
            padding: 0 15px;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 33.3333%;
                max-width: 33.3333%;
            }
        }
    </style>

    <script>
        // Function to preview image
        function previewImage(input, index) {
            const currentPreview = document.getElementById('current-foto-' + index);
            const previewContainer = document.getElementById('preview-container-' + index);
            const preview = document.getElementById('preview-' + index);
            const placeholder = document.getElementById('placeholder-' + index);

            if (currentPreview && input.files && input.files[0]) {
                currentPreview.style.display = 'none';
            }

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    if (previewContainer) previewContainer.style.display = 'block';
                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                        if (placeholder) placeholder.style.display = 'none';
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
