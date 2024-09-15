<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id(); 
            // Menggunakan timestamp untuk menyimpan tanggal dan waktu
            $table->timestamp('tgl_faktur')->useCurrent(); 
            $table->string('no_faktur', 50); 
            $table->string('nama_konsumen'); 
            $table->unsignedBigInteger('kode_barang'); 
            $table->integer('jumlah'); 
            $table->decimal('harga_satuan', 15, 2); 
            $table->decimal('harga_total', 15, 2); 

            $table->foreign('kode_barang')->references('id')->on('master_barangs')->onDelete('cascade'); 
            $table->timestamps(); // Menggunakan timestamps bawaan Laravel (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
