<?php

use App\Http\Controllers\PromosiController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/admin');
})->name('public');

// Template Routes
Route::prefix('template')->group(function () {
    Route::view('/', 'template.index');
    Route::view('/shop', 'template.index-1');
    Route::view('/email', 'template.email');
    Route::view('/typography', 'template.typography');
    Route::view('/alert', 'template.alert');
    Route::view('/buttons', 'template.buttons');
});

// Authentication Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// Middleware for authenticated routes
Route::middleware(['cek_login:1'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::view('/bansos', 'admin.bansos.index');
        Route::view('/pengumuman', 'admin.pengumuman.index');
        Route::view('/keuangan', 'admin.keuangan.index');

        // Admin-specific routes
        Route::prefix('promosi')->group(function () {
            Route::get('/', [PromosiController::class, 'index']);
            Route::get('/daftar', [PromosiController::class, 'daftar']);
            Route::post('/list', [PromosiController::class, 'list']);
            Route::get('/create', [PromosiController::class, 'create']);
            Route::post('/', [PromosiController::class, 'store']);
            Route::get('/{id}/show', [PromosiController::class, 'show']);
            Route::get('/{id}/edit', [PromosiController::class, 'edit']);
            Route::post('/{id}', [PromosiController::class, 'update']);
            Route::delete('/{id}', [PromosiController::class, 'destroy']);
            Route::post('/{id}/show/update-status', [PromosiController::class, 'updateStatus']);
        });

        Route::prefix('penduduk')->group(function () {
            Route::get('/', [PendudukController::class, 'index']);
            Route::post('/list', [PendudukController::class, 'list']);
            Route::get('/create', [PendudukController::class, 'create']);
            Route::post('/', [PendudukController::class, 'store']);
            Route::get('/{id}/show', [PendudukController::class, 'show']);
            Route::get('/{id}/edit', [PendudukController::class, 'edit']);
            Route::post('/{id}', [PendudukController::class, 'update']);
            Route::delete('/{id}', [PendudukController::class, 'destroy']);
        });

        Route::prefix('keluarga')->group(function () {
            Route::get('/', [KeluargaController::class, 'index']);
            Route::post('/list', [KeluargaController::class, 'list']);
            Route::get('/create', [KeluargaController::class, 'create']);
            Route::post('/', [KeluargaController::class, 'store']);
            Route::get('/{id}/show', [KeluargaController::class, 'show']);
            Route::get('/{id}/edit', [KeluargaController::class, 'edit']);
            Route::post('/{id}', [KeluargaController::class, 'update']);
            Route::delete('/{id}', [KeluargaController::class, 'destroy']);
            Route::get('/{id}/create_anggota', [KeluargaController::class, 'createAnggota']);
            Route::post('/{id}/anggota', [KeluargaController::class, 'storeAnggota']);
        });

        Route::prefix('surat')->group(function () {
            Route::get('/', [SuratController::class, 'index']);
            Route::post('/list', [SuratController::class, 'list']);
            Route::get('/create', [SuratController::class, 'create']);
            Route::post('/', [SuratController::class, 'store']);
            Route::get('/{id}/edit', [SuratController::class, 'edit']);
            Route::post('/{id}', [SuratController::class, 'update']);
            Route::delete('/{id}', [SuratController::class, 'delete']);
        });

        Route::prefix('jadwal')->group(function () {
            Route::get('/', [JadwalController::class, 'index']);
            Route::get('/update_kebersihan', [JadwalController::class, 'form_kebersihan']);
            Route::get('/update_keamanan', [JadwalController::class, 'form_keamanan']);
            Route::post('/kebersihan', [JadwalController::class, 'update_kebersihan']);
            Route::post('/keamanan', [JadwalController::class, 'update_keamanan']);
        });

        Route::prefix('akun')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/list', [UserController::class, 'list']);
            Route::get('/create', [UserController::class, 'create']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}/show', [UserController::class, 'show']);
            Route::get('/{id}/edit', [UserController::class, 'edit']);
            Route::put('/{id}', [UserController::class, 'update']);
            // Route::delete('/{id}', [UserController::class, 'destroy']);
        });

        Route::group(['prefix' => 'pengumuman'], function () {
            Route::get('/', [PengumumanController::class, 'index']);          // menampilkan halaman awal level
            Route::post('/list', [PengumumanController::class, 'list']);      //menampilkan data level dalam bentuk json untuk datatables
            Route::get('/create', [PengumumanController::class, 'create']);   // menampilkan halaman form tambah level
            Route::post('/', [PengumumanController::class, 'store']);         // menyimpan data level baru
            Route::get('/{id}/show', [PengumumanController::class, 'show']);       // menampilkan detail level
            Route::get('/{id}/edit', [PengumumanController::class, 'edit']);  // menampilkan halaman form edit level
            Route::post('/{id}', [PengumumanController::class, 'update']);     // menyimpan perubahan data level
            Route::post('ckeditor/upload', [PengumumanController::class, 'upload'])->name('ckeditor.upload');
            // Route::delete('/{id}', [PengumumanController::class, 'destroy']); // menghapus data level
        });

        Route::group(['prefix' => 'bansos'], function () {
            Route::get('/', [BansosController::class, 'index']); // Menampilkan daftar bansos
            Route::post('/list', [BansosController::class, 'list']); // Mengambil daftar bansos untuk DataTables
            Route::get('/create', [BansosController::class, 'create_bansos']); // Form tambah bansos
            Route::post('/', [BansosController::class, 'store_bansos']); // Menyimpan bansos baru
            Route::get('/{id}/show', [BansosController::class, 'show']); // Menampilkan detail bansos
            Route::get('/{id}/edit', [BansosController::class, 'edit_bansos']); // Form edit bansos
            Route::post('/{id}', [BansosController::class, 'update_bansos']); // Mengupdate bansos
            Route::delete('/{id}', [BansosController::class, 'delete_bansos']); // Menghapus bansos
            Route::get('/histori', [BansosController::class, 'cek_histori']); // Melihat histori penerimaan bansos
            Route::get('/histori/data', [BansosController::class, 'getHistoriData'])->name('bansos.data');

            // Menambahkan route untuk menampilkan detail kriteria
            Route::get('/detail_kriteria/{id}', [BansosController::class, 'show_kriteria']); // Menampilkan detail kriteria penerimaan bansos

            Route::get('/{id}/daftar', [BansosController::class, 'daftar']); // Menampilkan daftar ajuan bansos
            Route::post('/{id}/update_acc_bansos', [BansosController::class, 'update_acc_bansos']); // Memperbarui status ACC bansos

            // cek jawaban kriteria masing-masing keluarga
            Route::get('/{id_bansos}/keluarga/{id_keluarga}', [BansosController::class, 'show_kriteria']);
        });


        Route::group(['prefix' => 'kriteria'], function () {
            Route::get('/update', [KriteriaController::class, 'update_kriteria']); //menambahkan
            Route::post('/', [KriteriaController::class, 'store_kriteria']); // Menyimpan kriteria baru
            Route::get('/show', [KriteriaController::class, 'show_kriteria']); // melihat kriteria
        });
    });
});

// route untuk rw
Route::middleware(['cek_login:2'])->group(function () {
    Route::prefix('rw')->group(function () {
        Route::get('/', [AdminController::class, 'index_rw']);

        Route::prefix('penduduk')->group(function () {
            Route::get('/', [PendudukController::class, 'index_rw']);
            Route::post('/list', [PendudukController::class, 'list_rw']);
            Route::get('/{id}/show', [PendudukController::class, 'show_rw']);
        });

        Route::prefix('keluarga')->group(function () {
            Route::get('/', [KeluargaController::class, 'index_rw']);
            Route::post('/list', [KeluargaController::class, 'list_rw']);
            Route::get('/{id}/show', [KeluargaController::class, 'show_rw']);
        });
        Route::group(['prefix' => 'bansos'], function () {
            Route::get('/', [BansosController::class, 'index_rw']); // Menampilkan daftar bansos
            Route::post('/list', [BansosController::class, 'list_rw']); // Mengambil daftar bansos untuk DataTables
            Route::get('/create', [BansosController::class, 'create_bansos_rw']); // Form tambah bansos
            Route::post('/', [BansosController::class, 'store_bansos_rw']); // Menyimpan bansos baru
            Route::get('/{id}/show', [BansosController::class, 'show_rw']); // Menampilkan detail bansos
            Route::get('/{id}/edit', [BansosController::class, 'edit_bansos_rw']); // Form edit bansos
            Route::post('/{id}', [BansosController::class, 'update_bansos_rw']); // Mengupdate bansos
            Route::delete('/{id}', [BansosController::class, 'delete_bansos_rw']); // Menghapus bansos
            Route::get('/histori', [BansosController::class, 'cek_histori_rw']); // Melihat histori penerimaan bansos
            Route::get('/histori/data', [BansosController::class, 'getHistoriData_rw'])->name('bansos.data');

            // Menambahkan route untuk menampilkan detail kriteria
            Route::get('/detail_kriteria/{id}', [BansosController::class, 'show_kriteria_rw']); // Menampilkan detail kriteria penerimaan bansos

            Route::get('/{id}/daftar', [BansosController::class, 'daftar_rw']); // Menampilkan daftar ajuan bansos
            Route::post('/{id}/update_acc_bansos', [BansosController::class, 'update_acc_bansos_rw']); // Memperbarui status ACC bansos

            // cek jawaban kriteria masing-masing keluarga
            Route::get('/{id_bansos}/keluarga/{id_keluarga}', [BansosController::class, 'show_kriteria_rw']);
        });


        Route::group(['prefix' => 'kriteria'], function () {
            Route::get('/update', [KriteriaController::class, 'update_kriteria_rw']); //menambahkan
            Route::post('/', [KriteriaController::class, 'store_kriteria_rw']); // Menyimpan kriteria baru
            Route::get('/show', [KriteriaController::class, 'show_kriteria_rw']); // melihat kriteria
        });
    });
});
