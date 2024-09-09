<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penjualan;
use App\Models\MasterBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MasterBarangController extends Controller
{
    /* Data Dashboard */
    public function dashboard() {
        // Mengambil data penjualan beserta master barang terkait
        $penjualans = Penjualan::with('masterBarang')->get();
    
        // Mengambil data barang dari tabel master_barang
        $masterBarangs = MasterBarang::all();
    
        return view('admin.dashboard', compact('penjualans', 'masterBarangs'));
    }    
    
    /* Data Barang Penjualan */
    public function penjualanbarang(Request $request) {
        // Cek apakah ada input pencarian
        $search = $request->input('search');
    
        // Query dasar untuk mengambil data penjualan beserta relasi ke master_barang
        $penjualans = Penjualan::with('masterBarang');
    
        // Jika ada pencarian, filter berdasarkan nama konsumen atau nama barang
        if ($search) {
            $penjualans = $penjualans->where('nama_konsumen', 'LIKE', '%' . $search . '%')
                ->orWhereHas('masterBarang', function ($query) use ($search) {
                    $query->where('nama_barang', 'LIKE', '%' . $search . '%');
                });
        }
    
        // Paginasi hasil pencarian
        $penjualans = $penjualans->paginate(10);
    
        return view('admin.penjualan.index', compact('penjualans', 'search'));
    }
    

    /* Data CRUD sparepart */
    public function sparepartindex(Request $request)
    {
        // Cek apakah ada input pencarian
        $search = $request->input('search');

        // Jika ada pencarian, filter berdasarkan nama_barang
        if ($search) {
            $masterBarangs = MasterBarang::where('nama_barang', 'LIKE', '%' . $search . '%')
                            ->paginate(10);
        } else {
            // Jika tidak ada pencarian, tampilkan semua data dengan pagination
            $masterBarangs = MasterBarang::paginate(10);
        }

        return view('admin.masterbarang.index', compact('masterBarangs', 'search'));
    }

    public function create_sparepart() {
        return view('admin.masterbarang.create');
    }

    public function create_sparepartprosess(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:50',
            'nama_barang' => 'required|string|max:255',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'satuan' => 'required|string|max:10',
            'kategori' => 'required|in:original,second',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar ke storage/app/public
        if ($request->hasFile('gambar_barang')) {
            $imagePath = $request->file('gambar_barang')->store('barang', 'public');
            $validatedData['gambar_barang'] = $imagePath;
        }

        // Simpan data ke database
        MasterBarang::create($validatedData);

        return redirect()->route('sparepart')->with('success', 'Barang sparepart berhasil ditambahkan!');
    }

    public function sparepartedit($id)
    {
        // Mengambil data barang berdasarkan ID
        $barang = MasterBarang::findOrFail($id);
        return view('admin.masterbarang.edit', compact('barang'));
    }

    public function pareparteditprosess(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kode_barang' => 'required|string|max:50',
            'nama_barang' => 'required|string|max:255',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'satuan' => 'required|string|max:10',
            'kategori' => 'required|in:original,second',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg|max:2048', // Tidak wajib mengupload ulang gambar
        ]);

        // Cari data barang berdasarkan ID
        $barang = MasterBarang::findOrFail($id);

        // Jika ada file gambar yang diupload, upload gambar baru dan hapus yang lama
        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama
            if ($barang->gambar_barang) {
                Storage::delete('public/' . $barang->gambar_barang);
            }
            // Upload gambar baru
            $imagePath = $request->file('gambar_barang')->store('barang', 'public');
            $validatedData['gambar_barang'] = $imagePath;
        }

        // Update data barang
        $barang->update($validatedData);

        return redirect()->route('sparepart')->with('success', 'Barang sparepart berhasil diupdate!');
    }


    public function sparepartdelete($id)
    {
        // Cari data barang berdasarkan ID
        $barang = MasterBarang::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($barang->gambar_barang) {
            Storage::delete('public/' . $barang->gambar_barang);
        }

        // Hapus data barang
        $barang->delete();

        return redirect()->route('sparepart')->with('success', 'Barang sparepart berhasil dihapus!');
    }



    
    
}
