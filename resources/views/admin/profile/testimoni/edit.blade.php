@extends('layouts.app')

@section('title', 'Edit Testimoni')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Edit Testimoni</div>
        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <form action="{{ route('admin.testimoni.update', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                        <input type="number" name="urutan" id="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $testimoni->urutan) }}" required>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="is_active" class="form-label">Status</label>
                        <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active', $testimoni->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $testimoni->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $testimoni->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_pemberi" class="form-label">Nama Pemberi <span class="text-danger">*</span></label>
                <input type="text" name="nama_pemberi" id="nama_pemberi" class="form-control @error('nama_pemberi') is-invalid @enderror" value="{{ old('nama_pemberi', $testimoni->nama_pemberi) }}" required>
                @error('nama_pemberi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="isi" class="form-label">Isi Testimoni <span class="text-danger">*</span></label>
                <textarea name="isi" id="isi" rows="5" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi', $testimoni->isi) }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

          
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
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

.mb-2 {
    margin-bottom: 0.5rem;
}

.mt-1 {
    margin-top: 0.25rem;
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

.form-text {
    display: block;
    margin-top: 0.25rem;
    font-size: 80%;
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
    box-shadow: 0 1px 2px rgba(0,0,0,0.075);
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

.file-input:hover ~ .file-input-label .file-input-button {
    background-color: var(--primary-hover);
}
</style>


@endsection