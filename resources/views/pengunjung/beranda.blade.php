<!-- beranda.blade.php -->
@extends('app')

@section('style')
<style>
    .search-container {
        display: flex;
        justify-content: center;
        margin-top: 50px;
    }

    .custom-search-form {
        width: 90%;
        max-width: 1045px;
    }

    .custom-search-input {
        border-radius: 10px 0 0 10px;
        border: 2px solid #1E201E;
        padding: 10px 20px;
        width: 100% !important;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .custom-search-input:focus {
        border-color: #1E201E;
        box-shadow: 0 0 5px #1E201E; 
    }

    .custom-search-button {
        border-radius: 0 20px 20px 0;
        border: 2px solid #1E201E;
        background-color: #1E201E;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-search-button:hover {
        background-color: black;
        border-color: black;
    }

    .video-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .video-container iframe {
        width: 80%;
        height: 450px;
        border-radius: 10px;
    }

    h2 {
        font-family: "Poppins", sans-serif;
        font-weight: 550;
        color: #1E201E;
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
        color: #1E201E;
    }

    .card-text {
        color: #6c757d;
    }

    .btn-warning {
        background-color: #1E201E;
        border: none;
    }

    .btn-warning:hover {
        background-color: black;
    }

    /* Styles for additional sections */
    .section-container {
        margin-top: 80px;
    }

    .section-header {
        font-family: "Poppins", sans-serif;
        font-weight: 600;
        font-size: 24px;
        margin-bottom: 30px;
        text-align: center;
        color: #1E201E;
    }

    .about-us, .contact-us, .clients {
        text-align: center;
        font-family: "Poppins", sans-serif;
        color: #1E201E;
    }

    .contact-details {
        margin-top: 20px;
    }

    .contact-details p {
        margin: 5px 0;
        font-size: 16px;
    }

    .client-logos {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .client-logos img {
        max-width: 150px;
        max-height: 80px;
        transition: transform 0.3s ease;
    }

    .client-logos img:hover {
        transform: scale(1.1);
    }

    .content-container {
        margin-top: 50px; 
        display: flex;
        align-items: center; /* Center vertically */
        justify-content: space-between; /* Add spacing between text and image */
    }

    .text-description {
        flex: 1;
        margin-right: 30px; /* Increase margin for better spacing */
        text-align: justify;
        padding-left: 20px; 
    }

    .image-container {
        flex: 1;
        padding-left: 20px; 
    }

    .image-container img {
        max-width: 100%;
        height: 150%;
        border-radius: 10px;
    }

    /* Center the container */
    .centered-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    p {
        font-family: "Poppins", sans-serif;
        font-size: 15px;
    }

    .gallery-title {
        font-family: "Poppins", sans-serif;
        font-weight: 550;
        text-align: center;
        margin-bottom: 40px;
    }
</style>
@endsection

@section('content')

<div class="container">
        <!-- Tentang Kami Section -->
        <div class="container centered-container">
            <div class="row content-container">
                <h2 class="gallery-title">Tentang Automotif Sparepart Motor</h2>
                <div class="col-md-8 text-description">
                    <p>
                        &nbsp; &nbsp; &nbsp; Automotif Sparepart Motor adalah toko yang didirikan pada tahun 2010 dengan tujuan menyediakan berbagai suku cadang motor berkualitas tinggi di seluruh Indonesia. Dengan stok sparepart terlengkap dari berbagai merek terkenal, kami melayani ribuan pelanggan dari berbagai daerah. Kami berkomitmen untuk menjadi mitra terbaik bagi semua pemilik motor, menyediakan komponen yang handal untuk menjaga performa kendaraan Anda tetap optimal. Selain itu, kami juga memberikan layanan konsultasi dan pemasangan suku cadang, membantu pelanggan memahami kebutuhan perawatan motor mereka dengan lebih baik.
                        <br><br>
                        &nbsp; &nbsp; &nbsp; &nbsp; Di Automotif Sparepart Motor, kami percaya bahwa kualitas dan keandalan sparepart sangat penting untuk keselamatan dan kenyamanan berkendara. Dengan tenaga ahli yang berpengalaman, kami siap membantu pelanggan memilih komponen yang sesuai dan memberikan layanan instalasi yang profesional. Kami berkomitmen untuk memastikan bahwa setiap kendaraan yang menggunakan produk kami mendapatkan perawatan terbaik, sehingga dapat bertahan lebih lama dan berkinerja optimal di segala kondisi.
                        <br><br>
                        &nbsp; &nbsp; &nbsp; Kunjungi toko kami untuk menemukan berbagai macam sparepart, mulai dari mesin, sistem pengereman, hingga aksesori motor. Kami yakin bahwa dengan menyediakan produk berkualitas dan harga yang kompetitif, pelanggan kami dapat merasakan pengalaman berkendara yang lebih baik. Bersama Automotif Sparepart Motor, kami percaya bahwa perawatan yang baik adalah kunci untuk menjaga keselamatan dan performa kendaraan Anda.
                    </p>
                </div>
                
                <div class="col-md-4 image-container">
                    <img src="{{ asset('assets/img/sparepart.jpg') }}" class="img-fluid" alt="Deskripsi Gambar">
                </div>
            </div>
        </div>
</div>

@endsection

