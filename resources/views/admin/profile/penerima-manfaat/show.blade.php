@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Detail Penerima Manfaat</h2>
        <a href="{{ route('admin.penerima-manfaat.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.penerima-manfaat.edit', $penerimaManfaat->id) }}" class="btn btn-warning mr-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.penerima-manfaat.destroy', $penerimaManfaat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
            
            <div class="row">
                @for($i = 1; $i <= 6; $i++)
                    @php $field = 'foto'.$i; @endphp
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="m-0">Foto {{ $i }}</h5>
                            </div>
                            <div class="card-body text-center p-3">
                                @if($penerimaManfaat->$field)
                                    <img src="{{ Storage::url('penerima-manfaat/'.$penerimaManfaat->$field) }}" class="img-fluid rounded" style="max-height: 200px;">
                                @else
                                    <div class="py-5 text-center text-muted">
                                        <i class="fas fa-image fa-3x mb-3"></i>
                                        <p>Belum ada foto</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5 class="m-0">Informasi Tambahan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200px" class="bg-light">Tanggal Dibuat</th>
                            <td>{{ $penerimaManfaat->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Terakhir Diupdate</th>
                            <td>{{ $penerimaManfaat->updated_at->format('d F Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection