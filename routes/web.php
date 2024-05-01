<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

// login auth route
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// middleware, redirect to login when the /admin or /admin/** is typed
Route::group(['middleware' => ['cek_login:1']], function(){
    Route::resource('admin', AdminController::class);

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
});


