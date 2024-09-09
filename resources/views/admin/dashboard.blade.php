@extends('app')

@section('style')
    <style>
        .dashboard-container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8b400;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
        }

        .table th, .table td {
            vertical-align: middle;
        }
        
        .table thead th {
            background-color: #f8b400;
            color: white;
        }
    </style>
@endsection

@section('content')
<div class="container dashboard-container">
    <div class="row">
        <!-- Data Penjualan -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Data Penjualan (Sudah Melakukan Pemesanan)
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualans as $index => $penjualan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penjualan->nama_konsumen }}</td>
                                    <td>{{ $penjualan->masterBarang ? $penjualan->masterBarang->nama_barang : 'Barang tidak ditemukan' }}</td>
                                    <td>{{ $penjualan->jumlah }}</td>
                                    <td>Rp {{ number_format($penjualan->harga_total, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Barang yang Dikeluarkan (Data Barang yang Dibuat oleh Admin) -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    Data Barang yang Dibuat oleh Admin
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Kode Barang</th>
                                <th>Harga Jual</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($masterBarangs as $index => $barang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>Rp {{ number_format($barang->harga_jual, 2, ',', '.') }}</td>
                                    <td>{{ $barang->created_at->format('d-m-Y H:i') }}</td> <!-- Tanggal dibuat -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
