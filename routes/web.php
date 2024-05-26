<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanController;

Route::get('/', function () {
    return view('welcome');
});

// Template
Route::group(['prefix' => 'template'], function () {
    Route::get('/', function () {return view('template.index');});
    Route::get('/shop', function () {return view('template.index-1');});
    Route::get('/email', function () {return view('template.email');});
    Route::get('/typography', function () {return view('template.typography');});
    Route::get('/alert', function () {return view('template.alert');});
    Route::get('/buttons', function () {return view('template.buttons');});
});

// Admin, RT & RW Login
Route::get('/login', function () {
    return view('login');
});

// logout
Route::get('/logout', function () {
    return view('login');
});



// Route for admin (for template only, you can make your own controller with index inside and remove this)
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {return view('admin.index');});
    Route::get('/akun', function () {return view('admin.akun.index');});
    Route::get('/bansos', function () {return view('admin.bansos.index');});
    Route::get('/penduduk', function () {return view('admin.penduduk.index');});
    Route::get('/pengumuman', function () {return view('admin.pengumuman.index');});
    Route::get('/promosi', function () {return view('admin.promosi.index');});
    Route::get('/surat', function () {return view('admin.surat.index');});
    Route::get('/jadwal', function () {return view('admin.jadwal.index');});
    Route::get('/keuangan', function () {return view('admin.keuangan.index');});
});

Route::group(['prefix' => 'admin'], function () {
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
});

