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
        <h2>Data Penjualan Sparepart</h2>

        <!-- Form Pencarian -->
        <div class="search-container">
            <form method="GET" action="{{ route('penjualanbarang') }}" class="custom-search-form">
                <input type="text" name="search" class="custom-search-input" placeholder="Cari Nama Konsumen atau Barang" value="{{ $search ?? '' }}">
                <button type="submit" class="custom-search-button">Cari</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Faktur</th>
                    <th>No Faktur</th>
                    <th>Nama Konsumen</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $index => $penjualan)
                    <tr>
                        <td>{{ $index + $penjualans->firstItem() }}</td>
                        <td>{{ $penjualan->tgl_faktur }}</td>
                        <td>{{ $penjualan->no_faktur }}</td>
                        <td>{{ $penjualan->nama_konsumen }}</td>
                        <td>{{ $penjualan->kode_barang }}</td>
                        <!-- Menampilkan nama barang dari relasi masterBarang -->
                        <td>{{ $penjualan->masterBarang ? $penjualan->masterBarang->nama_barang : 'Barang tidak ditemukan' }}</td>
                        <td>{{ $penjualan->jumlah }}</td>
                        <td>Rp {{ number_format($penjualan->harga_satuan, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->harga_total, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $penjualans->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
