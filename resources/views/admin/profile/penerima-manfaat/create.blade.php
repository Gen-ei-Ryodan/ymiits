@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Tambah Data Penerima Manfaat</h2>
        <a href="{{ route('admin.penerima-manfaat.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
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

            <form action="{{ route('admin.penerima-manfaat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @for($i = 1; $i <= 6; $i++)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="m-0">Foto {{ $i }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="foto{{ $i }}" id="foto{{ $i }}" class="custom-file-input @error('foto{{ $i }}') is-invalid @enderror">
                                            <label class="custom-file-label" for="foto{{ $i }}">Pilih file</label>
                                        </div>
                                        @error('foto{{ $i }}')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted mt-2">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endpush