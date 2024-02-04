<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Masyarakat;
use App\Http\Controllers\Petugas;
use App\Http\Controllers\Register;

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

//Form Login
Route::get('/', [Login::class, 'form'])->name('login');
Route::post('/', [Login::class, 'proses']);
Route::get('/logout', [Login::class, 'logout'])->name('logout');

//Form Register
Route::get('/Register', [Register::class, 'form'])->name('register');


//Form Admin
Route::get('/Admin', [Admin::class, 'form'])->name('admin');
Route::get('/Admin/Barang', [Admin::class, 'formbarang'])->name('admin-barang');
Route::get('/Admin/hapusData/{id}', [Admin::class, 'HapusData'])->name('admin.hapusData');
Route::get('/Admin/editData/{id}', [Admin::class, 'formEdit'])->name('admin.editData');
Route::put('/Admin/updateData/{id}', [Admin::class, 'Update'])->name('admin.prosesEdit');
Route::post('/Admin/tambah-barang', [Admin::class, 'TambahData'])->name('admin.tambahData');

// Form Admin SIDEBAR MASYARAKAT
Route::get('/Admin/Masyarakat', [Admin::class, 'formMasyarakat'])->name('admin-masyarakat');
Route::post('/Admin/tambah-masyarakat', [Admin::class, 'TambahMasyarakat'])->name('admin.tambahMasyarakat');
Route::get('/Admin/hapusMasyarakat/{id}', [Admin::class, 'HapusMasyarakat'])->name('admin.hapusMasyarakat');
Route::get('/Admin/editMasyarakat/{id}', [Admin::class, 'formEditMasyarakat'])->name('admin.editMasyarakat');
Route::put('/Admin/updateMasyarakat/{id}', [Admin::class, 'UpdateMasyarakat'])->name('admin.prosesEditMasyarakat');


//Form Petugas
Route::get('/Petugas', [Petugas::class, 'form'])->name('petugas');
Route::get('/Petugas/Barang', [Petugas::class, 'formbarang'])->name('petugas-barang');
Route::get('/Petugas/Lelang', [Petugas::class, 'formlelang'])->name('petugas-lelang');
Route::post('/Petugas/tambah-lelang', [Petugas::class, 'TambahLelang'])->name('petugas.tambahLelang');


//Form Masyarakat
Route::get('/Masyarakat', [Masyarakat::class, 'form'])->name('masyarakat');
