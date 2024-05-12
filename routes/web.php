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

// login auth route
// Route::get('login', [AuthController::class, 'index'])->name('login');
// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// middleware, redirect to login when the /admin or /admin/** is typed

// Route::group(['middleware' => ['cek_login:1']], function () {
//     Route::get('admin', [AdminController::class, 'index']);


//     // Route for admin (for template only, you can make your own controller with index inside and remove this)
//     Route::group(['prefix' => 'admin'], function () {
//         Route::get('/', function () {
//             return view('admin.index');
//         });
//         Route::get('/akun', function () {
//             return view('admin.akun.index');
//         });
//         Route::get('/bansos', function () {
//             return view('admin.bansos.index');
//         });
//         //         Route::get('/penduduk', function () {return view('admin.penduduk.index');});
//         Route::get('/pengumuman', function () {
//             return view('admin.pengumuman.index');
//         });
//         Route::get('/promosi', function () {
//             return view('admin.promosi.index');
//         });
//         Route::get('/surat', function () {
//             return view('admin.surat.index');
//         });
//         Route::get('/jadwal', function () {
//             return view('admin.jadwal.index');
//         });
//         Route::get('/keuangan', function () {
//             return view('admin.keuangan.index');
//         });
//     });
// });

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

    // Route::group(['prefix' => 'penduduk'], function () {
    //     Route::get('/', [PendudukController::class, 'index']);
    //     Route::post('/list', [PendudukController::class, 'list']);
    //     Route::get('/create', [PendudukController::class, 'create']);
    //     Route::post('/', [PendudukController::class, 'store']);
    //     Route::get('/{id}/show', [PendudukController::class, 'show']);
    //     Route::get('/{id}/edit', [PendudukController::class, 'edit']);
    //     Route::post('/{id}', [PendudukController::class, 'update']);
    //     Route::delete('/{id}', [PendudukController::class, 'destroy']);
    // });
    // Route::group(['prefix' => 'keluarga'], function () {
    //     Route::get('/', [KeluargaController::class, 'index']);          // menampilkan halaman awal level
    //     Route::post('/list', [KeluargaController::class, 'list']);      //menampilkan data level dalam bentuk json untuk datatables
    //     Route::get('/create', [KeluargaController::class, 'create']);   // menampilkan halaman form tambah level
    //     Route::post('/', [KeluargaController::class, 'store']);         // menyimpan data level baru
    //     Route::get('/{id}/show', [KeluargaController::class, 'show']);       // menampilkan detail level
    //     Route::get('/{id}/edit', [KeluargaController::class, 'edit']);  // menampilkan halaman form edit level
    //     Route::post('/{id}', [KeluargaController::class, 'update']);     // menyimpan perubahan data level
    //     Route::delete('/{id}', [KeluargaController::class, 'destroy']); // menghapus data level

    //     Route::get('/{id}/create_anggota', [KeluargaController::class, 'createAnggota']); // nampilin form tambah detail keluarga
    //     Route::post('/{id}', [KeluargaController::class, 'storeAnggota']); // simpan data ke dalam database
    // });
    Route::group(['prefix' => 'akun'], function() {
        Route::get('/', [UserController::class, 'index']);              // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);          // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);       // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);             // menyimpan data user baru
        Route::get('/{id}', [UserController::class, 'show']);           // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);      // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);         // menyimpan perubahan data user
        Route::delete('/{id}', [UserController::class, 'destroy']);     // menghapus data user
    });
});
