@extends('app')

@section('style')
    <style>
        h2 {
            font-family: "Poppins", sans-serif;
            font-weight: 550;
        }

        .cards-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 70px;
            margin-top: 50px;
        }

        .card {
            width: 300px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            border-radius: 10px 10px 0 0;
            transition: transform 0.3s ease; 
        }

        .card img:hover {
            transform: scale(1.1); 
        }

        .zoomed {
            transform: scale(1.5); 
            z-index: 9999;
            position: relative;
            cursor: zoom-out;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text {
            color: #6c757d;
        }

        .btn-warning {
            background-color: orange;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e69500;
        }

        .modal-body img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <!-- Cards -->
    <h2 class="text-center mt-5">Produk Sparepart Motor</h2>
    <div class="cards-container">
        <!-- Looping Produk -->
        @foreach($spareparts as $sparepart)
        <div class="card">
            <img src="{{ asset('storage/'.$sparepart->gambar_barang) }}" class="card-img-top" alt="{{ $sparepart->nama_barang }}">
            <div class="card-body">
                <h5 class="card-title">{{ $sparepart->nama_barang }}</h5>
                <p class="card-text">Harga: Rp {{ number_format($sparepart->harga_jual, 2, ',', '.') }}</p>
                <a href="#" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#modalProduk{{ $sparepart->id }}">Lihat Detail</a>
            </div>
        </div>

        <!-- Modal Detail Produk dan Form Pemesanan -->
        <div class="modal fade" id="modalProduk{{ $sparepart->id }}" tabindex="-1" aria-labelledby="modalProdukLabel{{ $sparepart->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalProdukLabel{{ $sparepart->id }}">{{ $sparepart->nama_barang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/'.$sparepart->gambar_barang) }}" class="img-fluid mb-3" alt="{{ $sparepart->nama_barang }}">
                        <p>{{ $sparepart->deskripsi }}</p>
                        <p>Harga: Rp {{ number_format($sparepart->harga_jual, 2, ',', '.') }}</p>

                        <!-- Form Pemesanan -->
                        <form action="{{ route('produk-pesan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kode_barang" value="{{ $sparepart->kode_barang }}">
                            <div class="form-group">
                                <label for="nama_konsumen">Nama Konsumen</label>
                                <input type="text" name="nama_konsumen" id="nama_konsumen" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" required>
                            </div>
                            <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.card-img-top').on('click', function(){
            $(this).toggleClass('zoomed');
        });
    });
</script>
@endsection
