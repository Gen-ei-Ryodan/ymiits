@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Foto Pendiri</h3>
                @if (!$foto)
                    <a href="{{ route('admin.foto-pendiri.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-upload"></i> Upload Foto
                    </a>
                @endif
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($foto)
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Pendiri" class="img-thumbnail"
                                style="max-width: 400px; box-shadow: var(--shadow);">
                        </div>

                        <div class="d-flex mt-2">
                            <a href="{{ route('admin.foto-pendiri.edit', $foto->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Foto
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-image fa-4x" style="color: var(--text-light);"></i>
                        </div>
                        <p>Belum ada foto pendiri yang diupload.</p>
                        <a href="{{ route('admin.foto-pendiri.create') }}" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Foto
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
