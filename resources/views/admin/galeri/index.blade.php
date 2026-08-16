@extends('layouts.app')

@section('title', 'Kelola Galeri')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">Data Galeri</div>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Galeri
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="120">Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th width="120">Tanggal</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $index => $galeri)
                            <tr>
                                <td>{{ $index + $galleries->firstItem() }}</td>
                                <td class="text-center">
                                    <img src="{{ Storage::url($galeri->image) }}" alt="{{ $galeri->title }}"
                                        class="img-thumbnail gallery-thumbnail">
                                </td>
                                <td>{{ $galeri->title }}</td>
                                <td>{{ Str::limit($galeri->description, 50) }}</td>
                                <td>
                                    <span class="date-display">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ $galeri->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.galeri.show', $galeri) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger delete-confirm"
                                        data-id="{{ $galeri->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $galeri->id }}"
                                        action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-images"></i>
                                        <p>Belum ada data galeri. Silahkan tambahkan galeri terlebih dahulu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $galleries->links() }}
            </div>

        </div>
    </div>



    <style>
        /* Styling untuk pagination */
        .pagination {
            display: flex;
            list-style-type: none;
            margin: 20px 0;
            padding: 0;
            justify-content: center;
        }

        .pagination li {
            display: inline-block;
            margin: 0 2px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination li.active span {
            background-color: #3490dc;
            color: white;
            border-color: #3490dc;
        }

        .pagination li.disabled span {
            color: #aaa;
            cursor: not-allowed;
        }

        .pagination li a:hover {
            background-color: #f8f8f8;
            border-color: #bbb;
        }

        /* Memastikan class d-flex dan lainnya bekerja */
        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        /* Gallery thumbnail */
        .gallery-thumbnail {
            width: 100px;
            height: 75px;
            object-fit: cover;
            border-radius: 0.25rem;
            border: 1px solid var(--border);
            padding: 2px;
        }

        /* Date display */
        .date-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-dark);
            font-size: 0.9rem;
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

        /* Button styles untuk tombol aksi */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            display: inline-block;
            margin: 0 2px;
        }

        .text-center {
            text-align: center;
        }
    </style>



    <script>
        // Delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-confirm');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
