@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">📊 Jumlah Penerima Manfaat</h2>

                    @if ($homes->count() == 0)
                        <a href="{{ route('admin.homeangka.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Tambah Data
                        </a>
                    @endif
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @if ($homes->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Jumlah Penerima</th>
                                            <th scope="col">Foto 1</th>
                                            <th scope="col">Foto 2</th>

                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($homes as $home)
                                            <tr>
                                                <td>{{ $home->id }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-success fs-6">{{ number_format($home->jumlah_penerima_manfaat) }}</span>
                                                </td>
                                                <td>
                                                    @if ($home->foto_1)
                                                        <img src="{{ asset('storage/' . $home->foto_1) }}" alt="Foto 1"
                                                            style="max-height: 60px;" class="rounded">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($home->foto_2)
                                                        <img src="{{ asset('storage/' . $home->foto_2) }}" alt="Foto 2"
                                                            style="max-height: 60px;" class="rounded">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>

                                                <td class="text-end">
                                                    <a href="{{ route('admin.homeangka.edit', $home->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-3">
                                Belum ada data.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
