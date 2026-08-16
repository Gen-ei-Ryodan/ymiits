@extends('layouts.app')

@section('title', 'Tambah Pendiri/Pembina')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Tambah Data Pendiri/Pembina</div>
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
        
        <form action="{{ route('admin.pendiri-pembina.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="position" class="form-label">Jabatan</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position') }}" required>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.pendiri-pembina.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection