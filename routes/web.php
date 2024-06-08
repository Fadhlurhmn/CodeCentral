<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UserSuratController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserBansosController;
use App\Http\Controllers\UserPromosiController;
use App\Http\Controllers\UserPengaduanController;
use App\Http\Controllers\UserPengumumanController;


// User Routes
// Route::get('/', function () {
//     return view('index');
// })->name('user/landing');

// Route untuk halaman landing
Route::get('/', [HomeController::class, 'index'])->name('user.landing');

// Route untuk halaman pengumuman
Route::get('/pengumuman', [UserPengumumanController::class, 'index'])->name('user.pengumuman');
Route::get('/pengumuman/{id}', [UserPengumumanController::class, 'show'])->name('user.pengumuman.show');


Route::group(['prefix' => 'promosi'], function () {
    Route::get('/', [UserPromosiController::class, 'index'])->name('user.promosi');
    Route::get('/promosi', [UserPromosiController::class, 'create'])->name('user.promosi.create');
    Route::post('/promosi', [UserPromosiController::class, 'store'])->name('user.promosi.store');
    Route::post('/promosiVerif', [UserPromosiController::class, 'verifyDataDiri'])->name('verifyDataDiriPromosi');
});

Route::group(['prefix' => 'bansos'], function () {
    Route::get('/list', [UserBansosController::class, 'show'])->name('user.bansos.list');
    Route::get('/list/{id}', [UserBansosController::class, 'list'])->name('user.bansos.list.detail');
    Route::get('/pengajuan', [UserBansosController::class, 'pengajuan'])->name('user.bansos.pengajuan');
});

// bansos pengajuan form route
Route::post('/verify-data-diri', [UserBansosController::class, 'verifyDataDiri'])->name('verifyDataDiri');
Route::post('/submit-survey', [UserBansosController::class, 'submitSurvey'])->name('submitSurvey');


// Route untuk halaman surat
Route::get('/surat', [UserSuratController::class, 'index'])->name('user.surat');
Route::get('/surat/download/{id}', [UserSuratController::class, 'download']);

Route::get('/pengaduan', [UserPengaduanController::class, 'index'])->name('user.pengaduan');
Route::post('/pengaduanVerif', [UserPengaduanController::class, 'verifyDataDiri'])->name('verifyDataDiriPengaduan');
Route::post('/pengaduanStore', [UserPengaduanController::class, 'pengaduan'])->name('user.pengaduan.store');

// struktur rt rw
Route::get('/struktur', function () {
    return view('user.struktur.index');
})->name('user.struktur');

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
        Route::get('/profil', [UserController::class, 'profil']);
        Route::post('/profil', [UserController::class, 'editProfil']);

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
            Route::get('/{id}/preview', [SuratController::class, 'preview_surat']);
        });

        Route::prefix('jadwal')->group(function () {
            Route::get('/', [JadwalController::class, 'index']);
            Route::get('/update_kebersihan', [JadwalController::class, 'form_kebersihan']);
            Route::get('/update_keamanan', [JadwalController::class, 'form_keamanan']);
            Route::post('/kebersihan', [JadwalController::class, 'update_kebersihan']);
            Route::post('/keamanan', [JadwalController::class, 'update_keamanan']);
            Route::get('/satpam/{id}/delete', [JadwalController::class, 'destroy_satpam']);
        });

        Route::prefix('akun')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/list', [UserController::class, 'list']);
            Route::get('/create', [UserController::class, 'create']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}/show', [UserController::class, 'show']);
            Route::get('/{id}/edit', [UserController::class, 'edit']);
            Route::put('/{id}', [UserController::class, 'update']);
        });

        Route::prefix('jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index']);
            Route::post('/list', [JabatanController::class, 'list']);
            Route::get('/create', [JabatanController::class, 'create']);
            Route::post('/', [JabatanController::class, 'store']);
            Route::get('/{id}/edit', [JabatanController::class, 'edit']);
            Route::put('/{id}', [JabatanController::class, 'update']);
        });

        Route::group(['prefix' => 'pengumuman'], function () {
            Route::get('/', [PengumumanController::class, 'index']);          // menampilkan halaman awal pengumuman
            Route::post('/list', [PengumumanController::class, 'list']);      //menampilkan data pengumuman dalam bentuk json untuk datatables
            Route::get('/create', [PengumumanController::class, 'create']);   // menampilkan halaman form tambah pengumuman
            Route::post('/', [PengumumanController::class, 'store']);         // menyimpan data pengumuman baru
            Route::get('/{id}/show', [PengumumanController::class, 'show']);       // menampilkan detail pengumuman
            Route::get('/{id}/edit', [PengumumanController::class, 'edit']);  // menampilkan halaman form edit pengumuman
            Route::post('/{id}', [PengumumanController::class, 'update']);     // menyimpan perubahan data pengumuman
            Route::post('ckeditor/upload', [PengumumanController::class, 'upload'])->name('ckeditor.upload');
            Route::delete('/{id}', [PengumumanController::class, 'destroy']); // menghapus data pengumuman
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

            // cek perhitungan
            Route::get('/{id}/tampil_hitung', [BansosController::class, 'tampil_hitung']);
        });

        Route::group(['prefix' => 'kategori_bansos'], function () {
            Route::get('/', [BansosController::class, 'indexKategori']); // Menampilkan daftar kategori bansos
            Route::post('/list', [BansosController::class, 'listKategori']); // Mengambil daftar kategori bansos untuk DataTables
            Route::get('/create', [BansosController::class, 'createKategori']); // Form tambah kategori bansos
            Route::post('/', [BansosController::class, 'storeKategori']); // Menyimpan kategori bansos baru
            Route::get('/{id}/edit', [BansosController::class, 'editKategori']); // Form edit kategori bansos
            Route::post('/{id}', [BansosController::class, 'updateKategori']); // Mengupdate kategori bansos
            Route::delete('/{id}', [BansosController::class, 'deleteKategori'])->name('kategori_bansos.destroy'); // Menghapus kategori bansos
        });

        Route::group(['prefix' => 'kriteria'], function () {
            Route::get('/update', [KriteriaController::class, 'update_kriteria']); //menambahkan
            Route::post('/', [KriteriaController::class, 'store_kriteria']); // Menyimpan kriteria baru
            Route::get('/show', [KriteriaController::class, 'show_kriteria']); // melihat kriteria
        });

        Route::group(['prefix' => 'jadwal'], function () {
            Route::get('/', [JadwalController::class, 'index']);          // menampilkan halaman awal level

            // route satpam
            Route::group(['prefix' => 'satpam'], function () {
                Route::post('/list', [JadwalController::class, 'list_satpam']);      //menampilkan data level dalam bentuk json untuk datatables
                Route::get('/create', [JadwalController::class, 'create_satpam']);   // menampilkan halaman form tambah level
                Route::post('/', [JadwalController::class, 'store_satpam']);         // menyimpan data level baru
                Route::get('/{id}/edit', [JadwalController::class, 'edit_satpam']);  // menampilkan halaman form edit level
                Route::post('/{id}', [JadwalController::class, 'update_satpam']);     // menyimpan perubahan data level
                Route::delete('/{id}', [JadwalController::class, 'destroy_satpam']);
            });

            // route jadwal keamanan
            Route::group(['prefix' => 'keamanan'], function () {
                Route::post('/list', [JadwalController::class, 'list_jadwal_keamanan']);
                Route::get('/edit', [JadwalController::class, 'edit_jadwal_keamanan']);  // menampilkan halaman form edit level
                Route::post('/update', [JadwalController::class, 'update_jadwal_keamanan']);
                Route::post('/', [JadwalController::class, 'store_jadwal_keamanan']);
            });
            // route jadwal kebersihan
            Route::group(['prefix' => 'kebersihan'], function () {
                Route::post('/list', [JadwalController::class, 'list_jadwal_kebersihan']);
                Route::get('/edit', [JadwalController::class, 'edit_jadwal_kebersihan']);  // menampilkan halaman form edit level
                Route::post('/{id}', [JadwalController::class, 'update_jadwal_kebersihan']);
                Route::post('/', [JadwalController::class, 'store_jadwal_kebersihan']);
            });
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

            // cek perhitungan
            Route::get('/{id}/tampil_hitung', [BansosController::class, 'tampil_hitung']);
        });

        Route::group(['prefix' => 'kategori_bansos'], function () {
            Route::get('/', [BansosController::class, 'indexKategori']); // Menampilkan daftar kategori bansos
            Route::post('/list', [BansosController::class, 'listKategori']); // Mengambil daftar kategori bansos untuk DataTables
            Route::get('/create', [BansosController::class, 'createKategori']); // Form tambah kategori bansos
            Route::post('/', [BansosController::class, 'storeKategori']); // Menyimpan kategori bansos baru
            Route::get('/{id}/edit', [BansosController::class, 'editKategori']); // Form edit kategori bansos
            Route::post('/{id}', [BansosController::class, 'updateKategori']); // Mengupdate kategori bansos
            Route::delete('/{id}', [BansosController::class, 'deleteKategori']); // Menghapus kategori bansos
        });

        Route::group(['prefix' => 'kriteria'], function () {
            Route::get('/update', [KriteriaController::class, 'update_kriteria']); //menambahkan
            Route::post('/', [KriteriaController::class, 'store_kriteria']); // Menyimpan kriteria baru
            Route::get('/show', [KriteriaController::class, 'show_kriteria']); // melihat kriteria
        });
    });
});


// route untuk rt
Route::middleware(['cek_login:3'])->group(function () {
    Route::prefix('rt')->group(function () {
        Route::get('/', [AdminController::class, 'index_rt']);
        // Route::view('/bansos', 'rt.bansos.index');
        Route::view('/pengumuman', 'rt.pengumuman.index');
        Route::view('/keuangan', 'rt.keuangan.index');

        Route::prefix('penduduk')->group(function () {
            Route::get('/', [PendudukController::class, 'index_rt']);
            Route::post('/list', [PendudukController::class, 'list_rt']);
            Route::get('/create', [PendudukController::class, 'create_rt']);
            Route::post('/', [PendudukController::class, 'store_rt']);
            Route::get('/{id}/show', [PendudukController::class, 'show_rt']);
            Route::get('/{id}/edit', [PendudukController::class, 'edit_rt']);
            Route::post('/{id}', [PendudukController::class, 'update_rt']);
            Route::delete('/{id}', [PendudukController::class, 'destroy_rt']);
        });

        Route::prefix('keluarga')->group(function () {
            Route::get('/', [KeluargaController::class, 'index_rt']);
            Route::post('/list', [KeluargaController::class, 'list_rt']);
            Route::get('/create', [KeluargaController::class, 'create_rt']);
            Route::post('/', [KeluargaController::class, 'store_rt']);
            Route::get('/{id}/show', [KeluargaController::class, 'show_rt']);
            Route::get('/{id}/edit', [KeluargaController::class, 'edit_rt']);
            Route::post('/{id}', [KeluargaController::class, 'update_rt']);
            Route::delete('/{id}', [KeluargaController::class, 'destroy_rt']);
            Route::get('/{id}/create_anggota', [KeluargaController::class, 'createAnggota_rt']);
            Route::post('/{id}/anggota', [KeluargaController::class, 'storeAnggota_rt']);
        });

        // Route::group(['prefix' => 'bansos'], function () {
        //     Route::get('/', [BansosController::class, 'index_rt']); // Menampilkan daftar bansos
        //     Route::post('/list', [BansosController::class, 'list_rt']); // Mengambil daftar bansos untuk DataTables
        //     Route::get('/{id}/show', [BansosController::class, 'show_rt']); // Menampilkan detail bansos
        //     Route::get('/histori', [BansosController::class, 'cek_histori_rt']); // Melihat histori penerimaan bansos
        //     Route::get('/histori/data', [BansosController::class, 'getHistoriData_rt'])->name('bansos.data');

        //     // Menambahkan route untuk menampilkan detail kriteria
        //     Route::get('/detail_kriteria/{id}', [BansosController::class, 'show_kriteria_rt']); // Menampilkan detail kriteria penerimaan bansos

        //     Route::get('/{id}/daftar', [BansosController::class, 'daftar_rt']); // Menampilkan daftar ajuan bansos
        //     Route::post('/{id}/update_acc_bansos', [BansosController::class, 'update_acc_bansos_rt']); // Memperbarui status ACC bansos

        //     // cek jawaban kriteria masing-masing keluarga
        //     Route::get('/{id_bansos}/keluarga/{id_keluarga}', [BansosController::class, 'show_kriteria_rt']);
        // });

        // Route::group(['prefix' => 'kriteria'], function () {
        //     Route::get('/update', [KriteriaController::class, 'update_kriteria_rt']); //menambahkan
        //     Route::post('/', [KriteriaController::class, 'store_kriteria_rt']); // Menyimpan kriteria baru
        //     Route::get('/show', [KriteriaController::class, 'show_kriteria_rt']); // melihat kriteria
        // });
    });
});
