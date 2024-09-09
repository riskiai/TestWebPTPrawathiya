@extends('app')

@section('style')
    <style>
        .table-container {
            margin-top: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-icons a {
            color: #333;
            text-decoration: none;
        }

        .action-icons a:hover {
            color: #f8b400; 
        }

        .btn-tambah {
            margin-bottom: 20px;
            background-color: #f8b400; 
            color: white;
        }

        .btn-tambah:hover {
            background-color: #e69500; 
        }

        .btn-danger {
            background-color: #f8b400; 
            border-color: #f8b400;
        }

        .btn-danger:hover {
            background-color: #e69500; 
            border-color: #e69500;
        }

        /* CSS untuk pagination berwarna oranye */
        .pagination .page-link {
            color: #f8b400;
        }

        .pagination .page-item.active .page-link {
            background-color: #f8b400; 
            border-color: #f8b400; 
        }

        .pagination .page-item .page-link:hover {
            color: #e69500; 
        }

        .pagination .page-item.active .page-link:hover {
            background-color: #e69500; 
            border-color: #e69500; 
            color: white;
        }

        /* Menghilangkan fokus dan shadow dari pagination link */
        .pagination .page-link:focus {
            box-shadow: none;
            outline: none;
        }

        .search-container {
           display: flex;
           flex-direction: row;
           gap: 20px;
        }

        .custom-search-form {
            display: flex;
            justify-content: space-between;
        }

        .custom-search-input {
            border-radius: 5px;
            border: 2px solid #f8b400;
            padding: 8px;
            width: 80%;
            height: 70%;
        }

        .custom-search-input:focus {
            border-color: #e69500 solid;
        }

        .custom-search-button {
            border-radius: 5px;
            border: 2px solid #f8b400;
            background-color: #f8b400;
            color: white;
            padding: 8px 12px;
            cursor: pointer;
            height: 70%;
            margin-left: 10px !important;
        }

        .custom-search-button:hover {
            background-color: #e69500;
        }

        .img-thumbnail {
            max-width: 100px;
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div class="container table-container">
        <h2>Daftar Master Barang Sparepart Motor</h2>

        <!-- Form Pencarian -->
        <div class="search-container">
            <!-- Tombol Tambah Data -->
            <a href="{{ route('spareparttambah') }}" class="btn btn-tambah">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>

            <form method="GET" action="{{ route('sparepart') }}" class="custom-search-form">
                <input type="text" name="search" class="custom-search-input" placeholder="Cari Barang" value="{{ $search ?? '' }}">
                <button type="submit" class="custom-search-button">Cari</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Gambar Barang</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($masterBarangs as $index => $barang)
                    <tr>
                        <td>{{ $index + $masterBarangs->firstItem() }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($barang->harga_beli, 2, ',', '.') }}</td>
                        <td>{{ $barang->satuan }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$barang->gambar_barang) }}" alt="Gambar {{ $barang->nama_barang }}" class="img-thumbnail">
                        </td>
                        <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <div class="action-icons">
                                <!-- Link edit -->
                                <a href="{{ route('sparepartedit', $barang->id) }}" class="edit-icon" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <!-- Link delete -->
                                <button type="button" class="btn btn-link p-0 text-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $barang->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $masterBarangs->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
        
    </div>

    <!-- Modal untuk Konfirmasi Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus barang ini?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var barangId = button.getAttribute('data-id');
            var form = document.getElementById('deleteForm');
            form.action = '/delete-sparepart/' + barangId;
        });
    </script>
@endsection
