<?php

use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('public');

Route::get('/shop', function () {
    return view('index-1');
})->name('shop');

Route::get('/email', function () {
    return view('email');
})->name('email');

Route::get('/typography', function () {
    return view('typography');
})->name('typography');

Route::get('/alert', function () {
    return view('alert');
});

Route::get('/buttons', function () {
    return view('buttons');
});

Route::group(['prefix' => 'penduduk'], function () {
    Route::get('/', [PendudukController::class, 'index']);          // menampilkan halaman awal level
    Route::post('/list', [PendudukController::class, 'list']);      //menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [PendudukController::class, 'create']);   // menampilkan halaman form tambah level
    Route::post('/', [PendudukController::class, 'store']);         // menyimpan data level baru
    Route::get('/{id}/show', [PendudukController::class, 'show']);       // menampilkan detail level
    Route::get('/{id}/edit', [PendudukController::class, 'edit']);  // menampilkan halaman form edit level
    Route::post('/{id}', [PendudukController::class, 'update']);     // menyimpan perubahan data level
    Route::delete('/{id}', [PendudukController::class, 'destroy']); // menghapus data level
});
Route::group(['prefix' => 'keluarga'], function () {
    Route::get('/', [KeluargaController::class, 'index']);          // menampilkan halaman awal level
    Route::post('/list', [KeluargaController::class, 'list']);      //menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [KeluargaController::class, 'create']);   // menampilkan halaman form tambah level
    Route::post('/', [KeluargaController::class, 'store']);         // menyimpan data level baru
    Route::get('/{id}/show', [KeluargaController::class, 'show']);       // menampilkan detail level
    Route::get('/{id}/edit', [KeluargaController::class, 'edit']);  // menampilkan halaman form edit level
    Route::post('/{id}', [KeluargaController::class, 'update']);     // menyimpan perubahan data level
    Route::delete('/{id}', [KeluargaController::class, 'destroy']); // menghapus data level
});
