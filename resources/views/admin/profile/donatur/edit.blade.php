@extends('layouts.app')

@section('title', 'Edit Donatur')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Edit Data Donatur</div>
            <a href="{{ route('admin.donatur.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('admin.donatur.update', $donatur->id) }}" method="POST" enctype="multipart/form-data">
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

                <div class="form-group">
                    <label for="angka_donatur" class="form-label">Angka Donatur <span class="text-danger">*</span></label>
                    <input type="number" name="angka_donatur" id="angka_donatur"
                        class="form-control @error('angka_donatur') is-invalid @enderror"
                        value="{{ old('angka_donatur', $donatur->angka_donatur) }}" required>
                    @error('angka_donatur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto1" class="form-label">Foto 1</label>
                    @if ($donatur->foto1)
                        <div class="mb-2">
                            <img src="{{ Storage::url('donatur/' . $donatur->foto1) }}" alt="Foto 1" class="img-preview"
                                width="200">
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" name="foto1" id="foto1"
                            class="file-input @error('foto1') is-invalid @enderror">
                        <label for="foto1" class="file-input-label">
                            <span class="file-input-text">Pilih file baru (opsional)</span>
                            <span class="file-input-button">Browse</span>
                        </label>
                    </div>
                    @error('foto1')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                </div>

                <div class="form-group">
                    <label for="foto2" class="form-label">Foto 2</label>
                    @if ($donatur->foto2)
                        <div class="mb-2">
                            <img src="{{ Storage::url('donatur/' . $donatur->foto2) }}" alt="Foto 2" class="img-preview"
                                width="200">
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" name="foto2" id="foto2"
                            class="file-input @error('foto2') is-invalid @enderror">
                        <label for="foto2" class="file-input-label">
                            <span class="file-input-text">Pilih file baru (opsional)</span>
                            <span class="file-input-button">Browse</span>
                        </label>
                    </div>
                    @error('foto2')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                </div>

                <div class="form-group">
                    <label for="foto3" class="form-label">Foto 3</label>
                    @if ($donatur->foto3)
                        <div class="mb-2">
                            <img src="{{ Storage::url('donatur/' . $donatur->foto3) }}" alt="Foto 3" class="img-preview"
                                width="200">
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" name="foto3" id="foto3"
                            class="file-input @error('foto3') is-invalid @enderror">
                        <label for="foto3" class="file-input-label">
                            <span class="file-input-text">Pilih file baru (opsional)</span>
                            <span class="file-input-button">Browse</span>
                        </label>
                    </div>
                    @error('foto3')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
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

        /* Form styling */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
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

        /* Image preview */
        .img-preview {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 0.25rem;
            border: 1px solid #ddd;
            padding: 0.25rem;
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
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
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInputs = document.querySelectorAll('.file-input');

                fileInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        const fileNameSpan = this.nextElementSibling.querySelector('.file-input-text');
                        const imgPreviewWrapper = this.closest('.form-group').querySelector(
                            '.img-preview');
                        const reader = new FileReader();

                        if (this.files.length > 0) {
                            fileNameSpan.textContent = this.files[0].name;

                            reader.onload = function(e) {
                                if (imgPreviewWrapper) {
                                    imgPreviewWrapper.src = e.target.result;
                                    imgPreviewWrapper.style.display = 'block';
                                } else {
                                    const newImg = document.createElement('img');
                                    newImg.src = e.target.result;
                                    newImg.classList.add('img-preview', 'mt-2');
                                    newImg.style.width = '200px';
                                    input.closest('.form-group').prepend(newImg);
                                }
                            };
                            reader.readAsDataURL(this.files[0]);
                        } else {
                            fileNameSpan.textContent = 'Pilih file baru (opsional)';
                            // Optional: hide preview if needed
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection
