
<!-- resources/views/admin/program/wakaf/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Program Wakaf</h1>
    
    <div class="card">
        <div class="card-header">Informasi Program</div>
        <div class="card-body">
            <h2>Deskripsi Program</h2>
            <p>{{ $programWakaf->deskripsi }}</p>
            
            <div class="row">
                @for($i = 1; $i <= 3; $i++)
                    @php 
                        $fotoField = 'foto'.$i;
                        $judulField = 'sub_program'.$i.'_judul';
                        $deskripsiField = 'sub_program'.$i.'_deskripsi';
                    @endphp
                    
                    @if($programWakaf->$fotoField)
                    <div class="col-md-4 mb-3">
                        <h3>Foto {{ $i }}</h3>
                        <img src="{{ asset('storage/program/wakaf/'.$programWakaf->$fotoField) }}" class="img-fluid">
                    </div>
                    @endif
                @endfor
            </div>
            
            <div class="mt-4">
                @for($i = 1; $i <= 3; $i++)
                    @php 
                        $judulField = 'sub_program'.$i.'_judul';
                        $deskripsiField = 'sub_program'.$i.'_deskripsi';
                    @endphp
                    
                    <h2>Sub Program {{ $i }}</h2>
                    <h3>{{ $programWakaf->$judulField }}</h3>
                    <p>{{ $programWakaf->$deskripsiField }}</p>
                @endfor
            </div>
            
            <div class="mt-3">
                <a href="{{ route('admin.wakaf.edit', $programWakaf->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('admin.wakaf.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection