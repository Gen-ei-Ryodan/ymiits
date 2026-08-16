@extends('layouts.app')

@section('title', 'Detail Donatur')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Detail Data Donatur</div>
        <a href="{{ route('admin.donatur.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table detail-table">
                <tr>
                    <th width="200px">Angka Donatur</th>
                    <td>{{ number_format($donatur->angka_donatur) }}</td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $donatur->created_at->format('d F Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>{{ $donatur->updated_at->format('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="foto-grid">
            <div class="foto-item">
                <div class="foto-card">
                    <div class="foto-header">Foto 1</div>
                    <div class="foto-body">
                        @if($donatur->foto1)
                            <img src="{{ Storage::url('donatur/'.$donatur->foto1) }}" alt="Foto 1" class="foto-img">
                        @else
                            <div class="no-foto">
                                <i class="fas fa-image"></i>
                                <p>Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="foto-item">
                <div class="foto-card">
                    <div class="foto-header">Foto 2</div>
                    <div class="foto-body">
                        @if($donatur->foto2)
                            <img src="{{ Storage::url('donatur/'.$donatur->foto2) }}" alt="Foto 2" class="foto-img">
                        @else
                            <div class="no-foto">
                                <i class="fas fa-image"></i>
                                <p>Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="foto-item">
                <div class="foto-card">
                    <div class="foto-header">Foto 3</div>
                    <div class="foto-body">
                        @if($donatur->foto3)
                            <img src="{{ Storage::url('donatur/'.$donatur->foto3) }}" alt="Foto 3" class="foto-img">
                        @else
                            <div class="no-foto">
                                <i class="fas fa-image"></i>
                                <p>Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex">
        <a href="{{ route('admin.donatur.edit', $donatur->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form').submit()">
            <i class="fas fa-trash"></i> Hapus
        </button>
        <form id="delete-form" action="{{ route('admin.donatur.destroy', $donatur->id) }}" method="POST" style="display: none;">
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
}

.detail-table td {
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
}

/* Foto grid */
.foto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.foto-item {
    width: 100%;
}

.foto-card {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: var(--shadow);
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.foto-header {
    padding: 0.75rem 1rem;
    background-color: var(--secondary);
    color: var(--text-dark);
    font-weight: 600;
    border-bottom: 1px solid var(--border);
}

.foto-body {
    padding: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-grow: 1;
}

.foto-img {
    max-width: 100%;
    height: auto;
    border-radius: 0.25rem;
    display: block;
}

.no-foto {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    padding: 2rem;
    background-color: #f8f9fa;
    border-radius: 0.25rem;
    width: 100%;
}

.no-foto i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.no-foto p {
    margin: 0;
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .foto-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection