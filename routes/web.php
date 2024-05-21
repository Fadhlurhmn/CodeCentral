<?php

// use App\Http\Controllers\KeluargaController;
// use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    // return view('index');
    return redirect('/admin');
})->name('public');

// Template
Route::group(['prefix' => 'template'], function () {
    Route::get('/', function () {
        return view('template.index');
    });
    Route::get('/shop', function () {
        return view('template.index-1');
    });
    Route::get('/email', function () {
        return view('template.email');
    });
    Route::get('/typography', function () {
        return view('template.typography');
    });
    Route::get('/alert', function () {
        return view('template.alert');
    });
    Route::get('/buttons', function () {
        return view('template.buttons');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/akun', function () {
        return view('admin.akun.index');
    });
    Route::get('/bansos', function () {
        return view('admin.bansos.index');
    });
    Route::get('/penduduk', function () {
        return view('admin.penduduk.index');
    });
    Route::get('/pengumuman', function () {
        return view('admin.pengumuman.index');
    });
    Route::get('/surat', function () {
        return view('admin.surat.index');
    });
    Route::get('/jadwal', function () {
        return view('admin.jadwal.index');
    });
    Route::get('/keuangan', function () {
        return view('admin.keuangan.index');
    });

    Route::group(['prefix' => 'akun'], function() {
        Route::get('/', [UserController::class, 'index']);              // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);          // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);       // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);             // menyimpan data user baru
        Route::get('/{id}/show', [UserController::class, 'show']);           // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);      // menampilkan halaman form edit user
        Route::post('/{id}', [UserController::class, 'update']);         // menyimpan perubahan data user
        Route::delete('/{id}', [UserController::class, 'destroy']);     // menghapus data user
    });
});
