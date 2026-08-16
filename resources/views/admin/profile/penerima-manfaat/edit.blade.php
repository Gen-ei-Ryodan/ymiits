@extends('layouts.app')

@section('title', 'Edit Penerima Manfaat')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Edit Data Penerima Manfaat</div>
            <a href="{{ route('admin.penerima-manfaat.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <form action="{{ route('admin.penerima-manfaat.update', $penerimaManfaat->id) }}" method="POST"
            enctype="multipart/form-data">
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

                <div class="foto-grid">
                    @for ($i = 1; $i <= 6; $i++)
                        @php $field = 'foto'.$i; @endphp
                        <div class="foto-item">
                            <div class="foto-edit-card">
                                <div class="foto-header">Foto {{ $i }}</div>
                                <div class="foto-body">
                                    @if ($penerimaManfaat->$field)
                                        <div class="foto-preview" id="current-foto-{{ $i }}">
                                            <img src="{{ Storage::url('penerima-manfaat/' . $penerimaManfaat->$field) }}"
                                                alt="Foto {{ $i }}" class="foto-img">
                                        </div>
                                        {{-- Tambahan preview saat browse gambar baru --}}
                                        <div class="foto-preview empty" id="preview-container-{{ $i }}"
                                            style="display: none;">
                                            <div class="foto-placeholder" id="placeholder-{{ $i }}">
                                                <i class="fas fa-image"></i>
                                                <p>Preview foto</p>
                                            </div>
                                            <img src="" alt="" id="preview-{{ $i }}"
                                                class="foto-img" style="display: none;">
                                        </div>
                                    @else
                                        <div class="foto-preview empty" id="preview-container-{{ $i }}">
                                            <div class="foto-placeholder" id="placeholder-{{ $i }}">
                                                <i class="fas fa-image"></i>
                                                <p>Preview foto</p>
                                            </div>
                                            <img src="" alt="" id="preview-{{ $i }}"
                                                class="foto-img" style="display: none;">
                                        </div>
                                    @endif

                                    <div class="file-input-wrapper">
                                        <input type="file" name="foto{{ $i }}" id="foto{{ $i }}"
                                            class="file-input @error('foto{{ $i }}') is-invalid @enderror">
                                        <label for="foto{{ $i }}" class="file-input-label">
                                            <span
                                                class="file-input-text">{{ $penerimaManfaat->$field ? 'Ganti foto' : 'Pilih foto' }}</span>
                                            <span class="file-input-button">Browse</span>
                                        </label>
                                    </div>
                                    @error('foto{{ $i }}')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
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

        /* Foto grid */
        .foto-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .foto-item {
            width: 100%;
        }

        .foto-edit-card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .foto-header {
            padding: 0.75rem 1rem;
            background-color: var(--secondary);
            color: var(--text-dark);
            font-weight: 600;
            border-bottom: 1px solid var(--border);
        }

        .foto-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .foto-preview {
            text-align: center;
            margin-bottom: 1rem;
        }

        .foto-img {
            max-width: 100%;
            max-height: 150px;
            border-radius: 0.25rem;
            display: inline-block;
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .foto-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .foto-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInputs = document.querySelectorAll('.file-input');

        fileInputs.forEach(input => {
            input.addEventListener('change', function () {
                const index = this.id.replace('foto', '');
                const preview = document.getElementById('preview-' + index);
                const container = document.getElementById('preview-container-' + index);
                const placeholder = document.getElementById('placeholder-' + index);
                const current = document.getElementById('current-foto-' + index);

                const fileNameSpan = this.nextElementSibling.querySelector('.file-input-text');

                if (this.files.length > 0) {
                    fileNameSpan.textContent = this.files[0].name;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        if (preview) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        if (container) container.style.display = 'block';
                        if (placeholder) placeholder.style.display = 'none';
                        if (current) current.style.display = 'none';
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    fileNameSpan.textContent = current ? 'Ganti foto' : 'Pilih foto';
                    if (preview) preview.style.display = 'none';
                    if (placeholder) placeholder.style.display = 'block';
                    if (container) container.style.display = 'block';
                    if (current) current.style.display = 'block';
                }
            });
        });
    });
</script>
@endpush

@endsection
