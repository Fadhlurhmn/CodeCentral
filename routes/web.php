<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UserBansosController;
use App\Http\Controllers\UserPengumumanController;

// User Routes
Route::get('/', function () {
    return view('index');
})->name('user/landing');

// Route::get('/pengumuman', function () {
//     return view('user.pengumuman.index');
// })->name('user/pengumuman');

// Route::get('/pengumuman/{id}', function () {
//     return view('user.pengumuman.show');
// })->name('user/pengumuman/show');

Route::get('/pengumuman', [UserPengumumanController::class, 'index'])->name('user.pengumuman');
Route::get('/pengumuman/{id}', [UserPengumumanController::class, 'show'])->name('user.pengumuman.show');


Route::group(['prefix' => 'umkm'], function () {
    Route::get('/', function () {
        return view('user.umkm.index');
    })->name('user/umkm');

    Route::get('/promosi-umkm', function () {
        return view('user.umkm.create');
    })->name('user/umkm/create');
});

Route::group(['prefix' => 'bansos'], function () {
    Route::get('/list', [UserBansosController::class, 'list'])->name('user/bansos/list');
    Route::get('/pengajuan', [UserBansosController::class, 'pengajuan'])->name('user/bansos/pengajuan');
});

// bansos pengajuan form route
Route::post('/verify-data-diri', [UserBansosController::class, 'verifyDataDiri'])->name('verifyDataDiri');
Route::post('/submit-bansos', [UserBansosController::class, 'submitBansos'])->name('submitBansos');
Route::post('/submit-survey', [UserBansosController::class, 'submitSurvey'])->name('submitSurvey');

Route::get('/surat', function () {
    return view('user.surat.index');
})->name('user/surat');

Route::get('/pengaduan', function () {
    return view('user.pengaduan.index');
})->name('user/pengaduan');

// end User Routes

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
    });
});
