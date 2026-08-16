@extends('layouts.app')

@section('title', 'Detail Program Sosial Keumatan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-title">Detail Program Sosial Keumatan</div>
        <a href="{{ route('admin.sosial-keumatan.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="program-content">
            <div class="section-main">
                <h4 class="section-title">Deskripsi Program</h4>
                <div class="section-text">{{ $programSosialKeumatan->deskripsi }}</div>
            </div>

            <!-- Galeri Foto Section -->
            @php 
                $hasGallery = false;
                for($i = 1; $i <= 8; $i++) {
                    $fotoField = 'foto'.$i;
                    if($programSosialKeumatan->$fotoField) {
                        $hasGallery = true;
                        break;
                    }
                }
            @endphp
            
            @if($hasGallery)
            <div class="section-gallery">
                <h4 class="section-title">Galeri Program</h4>
                <div class="foto-grid">
                    @for($i = 1; $i <= 8; $i++)
                        @php 
                            $fotoField = 'foto'.$i;
                            $judulField = 'sub_program'.$i.'_judul';
                        @endphp
                        
                        @if($programSosialKeumatan->$fotoField)
                            <div class="foto-item">
                                <div class="foto-card">
                                    <div class="foto-body">
                                        <img src="{{ asset('storage/program/sosial-keumatan/'.$programSosialKeumatan->$fotoField) }}" alt="Foto Program {{ $i }}" class="foto-img">
                                    </div>
                                    <div class="foto-footer">
                                        @if($programSosialKeumatan->$judulField)
                                            {{ $programSosialKeumatan->$judulField }}
                                        @else
                                            Foto {{ $i }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            @endif

            <!-- Sub Programs Section -->
            @php 
                $hasSubPrograms = false;
                for($i = 1; $i <= 8; $i++) {
                    $judulField = 'sub_program'.$i.'_judul';
                    $deskripsiField = 'sub_program'.$i.'_deskripsi';
                    if($programSosialKeumatan->$judulField && $programSosialKeumatan->$deskripsiField) {
                        $hasSubPrograms = true;
                        break;
                    }
                }
            @endphp
            
            @if($hasSubPrograms)
            <div class="section-sub-programs">
                <h4 class="section-title">Sub Program</h4>
                <div class="sub-programs-grid">
                    @for($i = 1; $i <= 8; $i++)
                        @php 
                            $judulField = 'sub_program'.$i.'_judul';
                            $deskripsiField = 'sub_program'.$i.'_deskripsi';
                        @endphp
                        
                        @if($programSosialKeumatan->$judulField && $programSosialKeumatan->$deskripsiField)
                            <div class="sub-program-item">
                                <div class="sub-program-card">
                                    <div class="sub-program-header">{{ $programSosialKeumatan->$judulField }}</div>
                                    <div class="sub-program-body">
                                        <p>{{ $programSosialKeumatan->$deskripsiField }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="card-footer d-flex">
        <a href="{{ route('admin.sosial-keumatan.edit', $programSosialKeumatan->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
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

/* Program content styling */
.program-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.section-main,
.section-gallery,
.section-sub-programs {
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}

.section-text {
    line-height: 1.6;
    white-space: pre-line;
    background-color: var(--light);
    padding: 1rem;
    border-radius: 0.5rem;
    border: 1px solid var(--border);
}

/* Gallery styling */
.foto-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
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
    transition: transform 0.2s;
}

.foto-card:hover {
    transform: translateY(-3px);
}

.foto-body {
    height: 160px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    background-color: #f8f9fa;
}

.foto-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.foto-footer {
    padding: 0.5rem;
    background-color: white;
    font-weight: 500;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-top: 1px solid var(--border);
}

/* Sub programs styling */
.sub-programs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.sub-program-item {
    width: 100%;
}

.sub-program-card {
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: var(--shadow);
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.sub-program-header {
    padding: 0.75rem 1rem;
    background-color: var(--light);
    color: var(--text-dark);
    font-weight: 600;
    border-bottom: 1px solid var(--border);
}

.sub-program-body {
    padding: 1rem;
    line-height: 1.6;
}

.sub-program-body p {
    margin: 0;
    white-space: pre-line;
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
        grid-template-columns: repeat(2, 1fr);
    }
    
    .sub-programs-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .foto-grid {
        grid-template-columns: 1fr;
    }
    
    .card-footer {
        flex-wrap: wrap;
    }
    
    .btn {
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection