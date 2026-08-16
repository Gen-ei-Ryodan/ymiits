<!-- resources/views/admin/program/sosial-keumatan/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Program Sosial Keumatan')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Tambah Program Sosial Keumatan</div>
            <a href="{{ route('admin.sosial-keumatan.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('admin.sosial-keumatan.store') }}" method="POST" enctype="multipart/form-data">
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
                        <small class="form-text text-muted">Deskripsi ini akan ditampilkan pada halaman program sosial keumatan di
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
                <a href="{{ route('admin.sosial-keumatan.index') }}" class="btn btn-secondary ms-2">
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

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .ms-2 {
            margin-left: 0.5rem;
        }

        /* Section styling */
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #212529;
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
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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

        /* Button styling */
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>

    <script>
        let subProgramIndex = 1;

        function tambahSubProgram() {
            const container = document.getElementById('sub-program-container');
            const div = document.createElement('div');
            div.classList.add('sub-program-group', 'mb-4');
            div.dataset.index = subProgramIndex;

            div.innerHTML = `
                <div class="form-group">
                    <label>Judul Sub Program <span class="text-danger">*</span></label>
                    <input type="text" name="sub_programs[${subProgramIndex}][judul]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi Sub Program <span class="text-danger">*</span></label>
                    <textarea name="sub_programs[${subProgramIndex}][deskripsi]" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Foto Sub Program (opsional)</label>
                    <input type="file" name="sub_programs[${subProgramIndex}][foto]" class="form-control">
                </div>
                <button type="button" class="btn btn-danger mb-2" onclick="hapusSubProgram(${subProgramIndex})">Hapus Sub Program</button>
                <hr>
            `;

            container.appendChild(div);
            subProgramIndex++;
        }

        function hapusSubProgram(index) {
            const element = document.querySelector(`.sub-program-group[data-index="${index}"]`);
            if (element) {
                element.remove();
            }
        }
    </script>
@endsection
