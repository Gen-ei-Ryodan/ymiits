@extends('layouts.app') {{-- Ganti sesuai layout kamu --}}
@section('content')
    <div class="container">
        <h1>Edit Sub Program Keagamaan</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sub-program.update', $subProgram->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $subProgram->judul) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $subProgram->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Ganti Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
                @if ($subProgram->foto)
                    <p class="mt-2">Foto saat ini:</p>
                    <img src="{{ asset('storage/program/keagamaan/sub/' . $subProgram->foto) }}" alt="Foto"
                        width="200">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.keagamaan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
