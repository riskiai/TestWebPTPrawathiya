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
        Schema::create('master_barangs', function (Blueprint $table) {
            $table->id(); 
            $table->string('kode_barang', 50); 
            $table->string('nama_barang'); 
            $table->decimal('harga_jual', 15, 2); 
            $table->decimal('harga_beli', 15, 2); 
            $table->string('satuan', 10); 
            $table->string('gambar_barang');
            $table->enum('kategori', ['original', 'second']);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_barangs');
    }
};
