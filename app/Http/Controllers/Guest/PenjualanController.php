<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\MasterBarang;

class PenjualanController extends Controller
{
    public function beranda() {
        return view('pengunjung.beranda');
    }

    public function produk() {
        // Mengambil data sparepart dari tabel MasterBarang
        $spareparts = MasterBarang::all();
        return view('pengunjung.datajualbarang', compact('spareparts'));
    }

    public function produkpesan(Request $request) {
        // Validasi data
        $request->validate([
            'kode_barang' => 'required',
            'nama_konsumen' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);
    
        // Ambil data barang dari MasterBarang
        $barang = MasterBarang::where('kode_barang', $request->kode_barang)->first();
    
        // Generate nomor faktur otomatis (misalnya berdasarkan timestamp)
        $no_faktur = 'INV-' . time();  // Contoh pola nomor faktur dengan timestamp
    
        // Hitung total harga
        $harga_total = $barang->harga_jual * $request->jumlah;
    
        // Simpan data pesanan ke tabel penjualan
        Penjualan::create([
            'kode_barang' => $barang->kode_barang,
            'nama_konsumen' => $request->nama_konsumen,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $barang->harga_jual,
            'harga_total' => $harga_total,
            'tgl_faktur' => now(),  // Tambahkan nilai tgl_faktur
            'no_faktur' => $no_faktur,  // Tambahkan nomor faktur yang di-generate
        ]);
    
        return redirect()->back()->with('success', 'Pesanan berhasil dibuat.');
    }
    
    
}
