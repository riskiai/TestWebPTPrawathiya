<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Admin\MasterBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin/sparepart');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/loginprosess', [LoginController::class, 'login'])->name('loginprosess');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    /* Data Dashboard Barang Sparepart */
    Route::get('/admin/dashboard', [MasterBarangController::class, 'dashboard'])->name('dashboard');
    
    /* Data Sparepart */
    Route::get('/admin/sparepart', [MasterBarangController::class, 'sparepartindex'])->name('sparepart');
    Route::get('/admin/sparepart/tambah', [MasterBarangController::class, 'create_sparepart'])->name('spareparttambah');
    Route::post('/admin/sparepart/tambahprosess', [MasterBarangController::class, 'create_sparepartprosess'])->name('spareparttambahprosess');
    Route::get('/admin/sparepart/edit/{id}', [MasterBarangController::class, 'sparepartedit'])->name('sparepartedit');
    Route::post('/admin/sparepart/editprosess/{id}', [MasterBarangController::class, 'pareparteditprosess'])->name('spareparteditprosess');
    Route::delete('/delete-sparepart/{id}', [MasterBarangController::class, 'sparepartdelete'])->name('deletesparepart');

    /* Data Penjualan Barang Sparepart*/
    Route::get('/admin/penjualanbarang', [MasterBarangController::class, 'penjualanbarang'])->name('penjualanbarang');
    
});
    