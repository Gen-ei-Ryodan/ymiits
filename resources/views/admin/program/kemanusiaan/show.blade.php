<!-- resources/views/admin/program/kemanusiaan/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Program Kemanusiaan</h1>
    
    <div class="card">
        <div class="card-header">Informasi Program</div>
        <div class="card-body">
            <h2>Deskripsi Program</h2>
            <p>{{ $programKemanusiaan->deskripsi }}</p>
            
            <div class="row">
                @if($programKemanusiaan->foto1)
                <div class="col-md-6 mb-3">
                    <h3>Foto 1</h3>
                    <img src="{{ asset('storage/program/kemanusiaan/'.$programKemanusiaan->foto1) }}" class="img-fluid">
                </div>
                @endif
                
                @if($programKemanusiaan->foto2)
                <div class="col-md-6 mb-3">
                    <h3>Foto 2</h3>
                    <img src="{{ asset('storage/program/kemanusiaan/'.$programKemanusiaan->foto2) }}" class="img-fluid">
                </div>
                @endif
            </div>
            
            <div class="mt-4">
                <h2>Sub Program 1</h2>
                <h3>{{ $programKemanusiaan->sub_program1_judul }}</h3>
                <p>{{ $programKemanusiaan->sub_program1_deskripsi }}</p>
                
                <h2>Sub Program 2</h2>
                <h3>{{ $programKemanusiaan->sub_program2_judul }}</h3>
                <p>{{ $programKemanusiaan->sub_program2_deskripsi }}</p>
            </div>
            
            <div class="mt-3">
                <a href="{{ route('admin.kemanusiaan.edit', $programKemanusiaan->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('admin.kemanusiaan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection