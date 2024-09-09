@extends('app')

@section('style')
    <style>
        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8b400;
            color: white;
            font-weight: bold;
            font-family: "Poppins", sans-serif;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
        }

        .form-control:focus {
            border-color: orange;
            box-shadow: none;
        }

        .btn-submit {
            background-color: orange;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #e69500;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Barang Sparepart Motor</div>
                <div class="card-body">
                    <form action="{{ route('spareparteditprosess', $barang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $barang->kode_barang }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" step="0.01" class="form-control" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" step="0.01" class="form-control" id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $barang->satuan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori" required>
                                <option value="original" {{ $barang->kategori == 'original' ? 'selected' : '' }}>Original</option>
                                <option value="second" {{ $barang->kategori == 'second' ? 'selected' : '' }}>Second</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_barang" class="form-label">Gambar Barang</label>
                            <input type="file" class="form-control" id="gambar_barang" name="gambar_barang" accept="image/*">
                            @if($barang->gambar_barang)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/'.$barang->gambar_barang) }}" alt="Gambar {{ $barang->nama_barang }}" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-submit w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
