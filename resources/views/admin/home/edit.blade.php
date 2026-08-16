@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">✏️ Edit Jumlah Penerima Manfaat</h4>

                        <form action="{{ route('admin.homeangka.update', $home->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                                <input type="number" name="jumlah_penerima_manfaat"
                                    class="form-control form-control-lg @error('jumlah_penerima_manfaat') is-invalid @enderror"
                                    id="jumlah"
                                    value="{{ old('jumlah_penerima_manfaat', $home->jumlah_penerima_manfaat) }}" required>
                                @error('jumlah_penerima_manfaat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto 1 Saat Ini</label><br>
                                @if ($home->foto_1)
                                    <img src="{{ asset('storage/' . $home->foto_1) }}" alt="Foto 1"
                                        class="img-thumbnail mb-2" style="max-height: 150px;">
                                @else
                                    <p class="text-muted">Belum ada foto</p>
                                @endif
                                <input type="file" name="foto_1"
                                    class="form-control @error('foto_1') is-invalid @enderror">
                                @error('foto_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Foto 2 Saat Ini</label><br>
                                @if ($home->foto_2)
                                    <img src="{{ asset('storage/' . $home->foto_2) }}" alt="Foto 2"
                                        class="img-thumbnail mb-2" style="max-height: 150px;">
                                @else
                                    <p class="text-muted">Belum ada foto</p>
                                @endif
                                <input type="file" name="foto_2"
                                    class="form-control @error('foto_2') is-invalid @enderror">
                                @error('foto_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.homeangka.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
