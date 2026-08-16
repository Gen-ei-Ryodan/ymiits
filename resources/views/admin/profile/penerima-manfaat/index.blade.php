@extends('layouts.app')

@section('title', 'Kelola Penerima Manfaat')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Data Penerima Manfaat</div>
        @if(!isset($penerimaManfaat))
        <a href="{{ route('admin.penerima-manfaat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
        @endif
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

        @if(isset($penerimaManfaat))
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.penerima-manfaat.edit', $penerimaManfaat->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) document.getElementById('delete-form').submit()">
                    <i class="fas fa-trash"></i> Hapus
                </button>
                <form id="delete-form" action="{{ route('admin.penerima-manfaat.destroy', $penerimaManfaat->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            
            <div class="foto-grid">
                @for($i = 1; $i <= 6; $i++)
                    @php $field = 'foto'.$i; @endphp
                    <div class="foto-item">
                        <div class="foto-card">
                            <div class="foto-header">Foto {{ $i }}</div>
                            <div class="foto-body">
                                @if($penerimaManfaat->$field)
                                    <img src="{{ Storage::url('penerima-manfaat/'.$penerimaManfaat->$field) }}" alt="Foto {{ $i }}" class="foto-img">
                                @else
                                    <div class="no-foto">
                                        <i class="fas fa-image"></i>
                                        <p>Belum ada foto</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-info-circle"></i>
                <p>Belum ada data penerima manfaat. Silahkan tambahkan data terlebih dahulu.</p>
            </div>
        @endif
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

.justify-content-end {
    justify-content: flex-end;
}

.align-items-center {
    align-items: center;
}

.mb-3 {
    margin-bottom: 1rem;
}

.me-2 {
    margin-right: 0.5rem;
}

/* Alert styling */
.alert {
    position: relative;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
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

/* Foto grid */
.foto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
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
    max-height: 200px;
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .foto-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .foto-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection