<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterBarang; // Import model relasi

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [
        'tgl_faktur',
        'no_faktur',
        'nama_konsumen',
        'kode_barang',
        'jumlah',
        'harga_satuan',
        'harga_total',
    ];

    // Menonaktifkan auto-timestamps jika tidak dibutuhkan
    public $timestamps = true;

    // Relasi dengan tabel master_barangs
    public function masterBarang()
    {
        return $this->belongsTo(MasterBarang::class, 'kode_barang', 'id');
    }
}
