@extends('layouts.app')

@section('title', 'Detail Testimoni')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Detail Testimoni</div>
        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table detail-table">
                <tr>
                    <th width="200">Urutan</th>
                    <td>{{ $testimoni->urutan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $testimoni->is_active ? 'badge-success' : 'badge-secondary' }}">
                            {{ $testimoni->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>{{ $testimoni->judul }}</td>
                </tr>
                <tr>
                    <th>Nama Pemberi</th>
                    <td>{{ $testimoni->nama_pemberi }}</td>
                </tr>
                <tr>
                    <th>Isi Testimoni</th>
                    <td>{{ $testimoni->isi }}</td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $testimoni->created_at->format('d F Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>{{ $testimoni->updated_at->format('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex">
        <a href="{{ route('admin.testimoni.edit', $testimoni->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form').submit()">
            <i class="fas fa-trash"></i> Hapus
        </button>
        <form id="delete-form" action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<style>
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

.me-2 {
    margin-right: 0.5rem;
}

/* Detail table */
.detail-table {
    border-collapse: collapse;
    width: 100%;
}

.detail-table th {
    background-color: var(--secondary);
    padding: 0.75rem 1rem;
    font-weight: 600;
    color: var(--text-dark);
    border: 1px solid var(--border);
    vertical-align: top;
}

.detail-table td {
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
}

/* Badge style */
.badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
}

.badge-success {
    color: #fff;
    background-color: #28a745;
}

.badge-secondary {
    color: #fff;
    background-color: #6c757d;
}

/* Button styles */
.btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--primary-hover);
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: var(--danger);
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* For responsive table */
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>
@endsection