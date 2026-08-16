@extends('layouts.app')

@section('title', 'Kelola Donatur')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Data Donatur</div>
        @if($donaturs->isEmpty())
        <a href="{{ route('admin.donatur.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Donatur
        </a>
        @endif
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Foto 1</th>
                        <th>Foto 2</th>
                        <th>Foto 3</th>
                        <th>Angka Donatur</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donaturs as $key => $donatur)
                        <tr>
                            <td>{{ $donaturs->firstItem() + $key }}</td>
                            <td>
                                @if($donatur->foto1)
                                    <img src="{{ Storage::url('donatur/'.$donatur->foto1) }}" width="80px" alt="Foto 1">
                                @else
                                    <span class="badge badge-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>
                                @if($donatur->foto2)
                                    <img src="{{ Storage::url('donatur/'.$donatur->foto2) }}" width="80px" alt="Foto 2">
                                @else
                                    <span class="badge badge-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>
                                @if($donatur->foto3)
                                    <img src="{{ Storage::url('donatur/'.$donatur->foto3) }}" width="80px" alt="Foto 3">
                                @else
                                    <span class="badge badge-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ number_format($donatur->angka_donatur) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.donatur.show', $donatur->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.donatur.edit', $donatur->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($donaturs->count() > 1)
                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $donatur->id }}').submit()">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $donatur->id }}" action="{{ route('admin.donatur.destroy', $donatur->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $donaturs->links() }}
    </div>
</div>

<style>
/* Tambahan CSS untuk memastikan tombol dalam satu baris */
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    display: inline-block;
    margin: 0 2px;
}

.table td.text-center {
    text-align: center;
}

.table th.text-center {
    text-align: center;
}

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

.table-hover tbody tr:hover {
    background-color: var(--secondary);
}

.table-responsive {
    overflow-x: auto;
}

/* Style badge */
.badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
}

.badge-secondary {
    color: #fff;
    background-color: #6c757d;
}

/* Tombol berwarna */
.btn-info {
    background-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

/* Footer pagination */
.clearfix::after {
    display: block;
    clear: both;
    content: "";
}
</style>
@endsection