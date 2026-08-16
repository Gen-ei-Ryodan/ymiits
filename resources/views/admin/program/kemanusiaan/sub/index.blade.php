@extends('layouts.app')

@section('title', 'Sub Program Kemanusiaan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Sub Program Kemanusiaan</div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSubProgramModal">
            <i class="fas fa-plus"></i> Tambah Sub Program
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subPrograms as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 100) }}</td>
                        <td>
                            @if($item->foto)
                            <img src="{{ asset('storage/program/kemanusiaan/sub/' . $item->foto) }}" alt="{{ $item->judul }}" class="img-thumbnail" width="100">
                            @else
                            <span class="badge bg-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.sub-program-kemanusiaan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.sub-program-kemanusiaan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sub program ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data sub program</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Sub Program -->
<div class="modal fade" id="tambahSubProgramModal" tabindex="-1" aria-labelledby="tambahSubProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.sub-program-kemanusiaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSubProgramModalLabel">Tambah Sub Program Kemanusiaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="program_kemanusiaan_id" class="form-label">Program Kemanusiaan</label>
                        <select name="program_kemanusiaan_id" id="program_kemanusiaan_id" class="form-select @error('program_kemanusiaan_id') is-invalid @enderror" required>
                            <option value="">Pilih Program</option>
                            @foreach($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->judul }}</option>
                            @endforeach
                        </select>
                        @error('program_kemanusiaan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="judul" class="form-label">Judul Sub Program</label>
                        <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                        <small class="text-muted">Format: JPG, PNG, JPEG, GIF (Maks: 2MB)</small>
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 