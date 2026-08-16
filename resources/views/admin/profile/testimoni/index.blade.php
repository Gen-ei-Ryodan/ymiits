@extends('layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Data Testimoni</div>
        <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Testimoni
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($testimonis->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="80">Urutan</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Pemberi</th>
                            <th width="100" class="text-center">Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonis as $key => $testimoni)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $testimoni->urutan }}</td>
                            <td>{{ $testimoni->judul }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($testimoni->isi, 100) }}</td>
                            <td>{{ $testimoni->nama_pemberi }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.testimoni.toggle-active', $testimoni->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $testimoni->is_active ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $testimoni->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.testimoni.show', $testimoni->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $testimoni->id }}').submit()">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $testimoni->id }}" action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-info-circle"></i>
                <p>Belum ada data testimoni. Silahkan tambahkan data terlebih dahulu.</p>
            </div>
        @endif
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

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Empty state styling */
.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 3rem 1rem;
    text-align: center;
    color: #6c757d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--primary);
}

.empty-state p {
    font-size: 1.1rem;
    max-width: 500px;
    margin: 0;
}
</style>
@endsection