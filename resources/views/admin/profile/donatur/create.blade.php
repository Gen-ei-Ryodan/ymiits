@extends('layouts.app')

@section('title', 'Tambah Donatur')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Tambah Data Donatur</div>
            <a href="{{ route('admin.donatur.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('admin.donatur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                        class="form-control @error('angka_donatur') is-invalid @enderror" value="{{ old('angka_donatur') }}"
                        required>
                    @error('angka_donatur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto1" class="form-label">Foto 1</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="foto1" id="foto1"
                            class="file-input @error('foto1') is-invalid @enderror">
                        <label for="foto1" class="file-input-label">
                            <span class="file-input-text">Pilih file</span>
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
                    <div class="file-input-wrapper">
                        <input type="file" name="foto2" id="foto2"
                            class="file-input @error('foto2') is-invalid @enderror">
                        <label for="foto2" class="file-input-label">
                            <span class="file-input-text">Pilih file</span>
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
                    <div class="file-input-wrapper">
                        <input type="file" name="foto3" id="foto3"
                            class="file-input @error('foto3') is-invalid @enderror">
                        <label for="foto3" class="file-input-label">
                            <span class="file-input-text">Pilih file</span>
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
                <button type="submit" class="btn btn-primary">Simpan</button>
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
            // Update file input label with selected filename
            document.addEventListener('DOMContentLoaded', function() {
                const fileInputs = document.querySelectorAll('.file-input');

                fileInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        const fileNameSpan = this.nextElementSibling.querySelector('.file-input-text');
                        fileNameSpan.textContent = this.files.length > 0 ? this.files[0].name :
                            'Pilih file';
                    });
                });
            });
        </script>
    @endpush
@endsection
