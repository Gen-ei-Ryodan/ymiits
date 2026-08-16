@extends('layouts.app')

@section('title', 'Tambah Program Keagamaan')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Tambah Program Keagamaan</div>
            <a href="{{ route('admin.keagamaan.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('admin.keagamaan.store') }}" method="POST" enctype="multipart/form-data">
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

                <div class="form-section">
                    <h4 class="section-title">Informasi Umum</h4>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi Program <span
                                class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="6" class="form-control @error('deskripsi') is-invalid @enderror"
                            required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Deskripsi ini akan ditampilkan pada halaman program keagamaan di
                            website.</small>
                    </div>
                </div>

                <div class="form-section" id="sub-program-container">
                    <h4 class="section-title">Sub Program</h4>

                    <div class="sub-program-group mb-4" data-index="0">
                        <div class="form-group">
                            <label>Judul Sub Program <span class="text-danger">*</span></label>
                            <input type="text" name="sub_programs[0][judul]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Sub Program <span class="text-danger">*</span></label>
                            <textarea name="sub_programs[0][deskripsi]" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Sub Program (opsional)</label>
                            <input type="file" name="sub_programs[0][foto]" class="form-control">
                        </div>
                        <hr>
                    </div>
                </div>

                <button type="button" class="btn btn-success mb-3" onclick="tambahSubProgram()">+ Tambah Sub
                    Program</button>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.keagamaan.index') }}" class="btn btn-secondary ms-2">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    <style>
        /* Utility classes */
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
            font-size: 80%;
        }

        /* Foto utama preview styling */
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

        /* Sub program preview (baru) */
        .sub-foto-preview {
            border: 1px dashed #ccc;
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .sub-foto-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #aaa;
        }

        .sub-foto-placeholder i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
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

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <script>
        let subProgramCount = 1;

        function tambahSubProgram() {
            const container = document.getElementById('sub-program-container');
            const newGroup = document.createElement('div');
            newGroup.className = 'sub-program-group mb-4';
            newGroup.dataset.index = subProgramCount;

            newGroup.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Sub Program #${subProgramCount + 1}</h5>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusSubProgram(this)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="form-group">
                    <label>Judul Sub Program <span class="text-danger">*</span></label>
                    <input type="text" name="sub_programs[${subProgramCount}][judul]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi Sub Program <span class="text-danger">*</span></label>
                    <textarea name="sub_programs[${subProgramCount}][deskripsi]" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Foto Sub Program (opsional)</label>
                    <input type="file" name="sub_programs[${subProgramCount}][foto]" class="form-control">
                </div>
                <hr>
            `;

            container.appendChild(newGroup);
            subProgramCount++;
        }

        function hapusSubProgram(button) {
            const groupToRemove = button.closest('.sub-program-group');
            groupToRemove.remove();
        }
    </script>
@endsection
