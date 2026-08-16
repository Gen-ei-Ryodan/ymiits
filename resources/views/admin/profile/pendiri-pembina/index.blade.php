@extends('layouts.app')

@section('title', 'Kelola Pendiri/Pembina')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Data Pendiri/Pembina</div>
        <a href="{{ route('admin.pendiri-pembina.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
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
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->position }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.pendiri-pembina.edit', $item) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $item->id }}').submit()">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.pendiri-pembina.destroy', $item) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
</style>
@endsection