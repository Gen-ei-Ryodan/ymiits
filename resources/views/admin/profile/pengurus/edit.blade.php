@extends('layouts.app')

@section('title', 'Edit Pengurus')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Data Pengurus</div>
    </div>
    <div class="card-body">
        <!-- Alert untuk error -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.pengurus.update', $pengurus) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $pengurus->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="position" class="form-label">Jabatan</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $pengurus->position) }}" required>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.pengurus.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection