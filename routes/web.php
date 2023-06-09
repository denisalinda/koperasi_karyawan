<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\admin\Dasboard;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\Kelola_anggota;
use App\Http\Controllers\admin\Kelola_unit_usaha;
use App\Http\Controllers\admin\C_pinjaman;
use App\Http\Controllers\admin\C_Pengajuan;
use App\Http\Controllers\admin\C_Angsuran;
use App\Http\Controllers\admin\C_simpanan;
use App\Http\Controllers\admin\C_Data_anggota;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['guest', 'revalidate'])->group(function () {
Route::get('/', [Login::class, 'view_login'])->name('login');
Route::post('/login', [Login::class, 'action_login']);
});

Route::middleware(['auth', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [Dasboard::class, 'view_dasboard']);
    });
});
//  pengawas dan ketua
Route::middleware(['checkrole:superadmin,pengawas,ketua', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/tabel-user', [UserController::class, 'view_user']);
        Route::get('/tabel-user/data', [UserController::class, 'get_data']);
    });
});
// ketua
Route::middleware(['checkrole:superadmin', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/tabel-user/tambah', [UserController::class, 'aksi_tambah_data']);
        Route::post('/tabel-user/edit', [UserController::class, 'edit_data']);
        Route::post('/tabel-user/hapus', [UserController::class, 'delete']);
    });
});

// sekretaris dan pengawas dan ketua
Route::middleware(['checkrole:sekretaris,pengawas,ketua', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/tabel-anggota', [Kelola_anggota::class, 'tabel_anggota']);
        Route::get('/tabel-anggota/data', [Kelola_anggota::class, 'get_anggota']);

        Route::get('/tabel-unit-usaha', [Kelola_unit_usaha::class, 'tabel_unit_usaha']);
        Route::get('/tabel-unit-usaha/data', [Kelola_unit_usaha::class, 'get_unit_usaha']);


    });
});
Route::middleware(['checkrole:sekretaris', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::post('/tabel-anggota/tambah', [Kelola_anggota::class, 'aksi_tambah_anggota']);
        Route::post('/tabel-anggota/edit', [Kelola_anggota::class, 'edit_data']);
        Route::post('/tabel-anggota/hapus', [Kelola_anggota::class, 'delete']);

        Route::post('/tabel-unit-usaha/tambah', [Kelola_unit_usaha::class, 'tambah_unit_usaha']);
        Route::post('/tabel-unit-usaha/edit', [Kelola_unit_usaha::class, 'edit_unit_usaha']);
        Route::post('/tabel-unit-usaha/hapus', [Kelola_unit_usaha::class, 'hapus_unit_usaha']);

    });
});
// pengawas dan bendahara dan ketua
Route::middleware(['checkrole:bendahara,pengawas,ketua', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/tabel-pengajuan', [C_pinjaman::class, 'tabel_pengajuan']);
        Route::get('/tabel-pengajuan/data', [C_pinjaman::class, 'get_data_pinjaman']);


        Route::get('/tabel-angsuran', [C_Angsuran::class, 'tabel_angsuran']);
        Route::get('/tabel-angsuran/data', [C_Angsuran::class, 'get_data_angsuran']);


        Route::get('/tabel-simpanan', [C_simpanan::class, 'tabel_saldo']);
        Route::get('/tabel-simpanan/data', [C_simpanan::class, 'get_simpanan']);

        Route::get('/tabel-simpanan-sukarela', [C_simpanan::class, 'tabel_simpanan_sukarela']);
        Route::get('/tabel-simpanan-sukarela/data', [C_simpanan::class, 'get_simpanan_sukarela']);

        Route::get('/tabel-simpanan-wajib', [C_simpanan::class, 'tabel_simpanan_wajib']);
        Route::get('/tabel-simpanan-wajib/data', [C_simpanan::class, 'get_simpanan_wajib']);

        Route::get('/tabel-riwayat-transaksi', [C_simpanan::class, 'tabel_riwayat']);
        Route::get('/tabel-riwayat-transaksi/data', [C_simpanan::class, 'get_data']);
        
        Route::get('/tabel-anggota-pinjaman', [C_Data_anggota::class, 'index']);
        Route::get('/tabel-anggota-pinjaman/data', [C_Data_anggota::class, 'get_data']);
        Route::get('/tabel-anggota-pinjaman/{id}', [C_Data_anggota::class, 'data_anggota']);
        Route::post('/tabel-anggota-pinjaman/angsuran', [C_Data_anggota::class, 'get_data_angsuran']);
        Route::post('/tabel-anggota-pinjaman/angsuran/data', [C_Data_anggota::class, 'get_angsuran']);


    });
});
// bendahara
Route::middleware(['checkrole:bendahara', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::post('/tabel-pengajuan/tambah', [C_pinjaman::class, 'tambah_pengajuan']);
        Route::post('/tabel-pengajuan/edit', [C_pinjaman::class, 'edit_pengajuan']);
        Route::post('/tabel-pengajuan/hapus', [C_pinjaman::class, 'hapus_pengajuan']);
        Route::post('/tabel-pengajuan/pencairan', [C_pinjaman::class, 'bukti_pencairan']);

        Route::post('/tabel-angsuran/bayar', [C_Angsuran::class, 'bayar_angsuran']);

        Route::post('/tabel-simpanan/setor', [C_simpanan::class, 'setor_simpanan']);
        Route::post('/tabel-simpanan/tarik', [C_simpanan::class, 'tarik_saldo']);




    });
});
// ketua dan pengawas
Route::middleware(['checkrole:ketua,pengawas', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/tabel-ketua-pengajuan', [C_Pengajuan::class, 'tabel_pengajuan']);
        Route::get('/tabel-ketua-pengajuan/data', [C_Pengajuan::class, 'get_data_pengajuan']);
        Route::get('/tabel-ketua-pengajuan/data-angsuran', [C_Pengajuan::class, 'get_angsuran']);
        Route::get('/tabel-rekomendasi', [C_pinjaman::class, 'tabel_rekomendasi']);
        Route::get('/tabel-rekomendasi/data', [C_pinjaman::class, 'get_pinjaman']);

    });
});
Route::middleware(['checkrole:ketua', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/tabel-ketua-pengajuan/acc', [C_Pengajuan::class, 'acc_pengajuan']);

    });
});
Route::middleware(['checkrole:pengawas', 'revalidate'])->group(function () {
    Route::prefix('admin')->group(function () {
      Route::post('/tabel-rekomendasi/aksi', [C_pinjaman::class, 'rekomendasi_aksi']);
      Route::post('/tabel-rekomendasi/tolak', [C_pinjaman::class, 'rekomendasi_aksi_tolak']);
    });
});
Route::get('/logout', [Login::class, 'logout']);
