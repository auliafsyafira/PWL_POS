<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\FileUploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
    Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori barang
    Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori barang
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [BarangController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah kategori barang
    Route::post('/', [BarangController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data kategori barang
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [StokController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [StokController::class, 'create'])->name('stok.simpan_edit');   // menampilkan halaman form tambah kategori barang
    Route::post('/', [StokController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [StokController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [StokController::class, 'update']);     // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data kategori barang
});

Route::group(['prefix' => 'transaksi'], function () {
    Route::get('/', [TransaksiController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [TransaksiController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [TransaksiController::class, 'create']);   // menampilkan halaman form tambah kategori barang
    Route::post('/', [TransaksiController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [TransaksiController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [TransaksiController::class, 'edit']);  // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [TransaksiController::class, 'update']);     // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [TransaksiController::class, 'destroy']); // menghapus data kategori barang
});

// Jobsheet 9
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// kita atur juga untuk middleware menggunakan group pada routing
// didalamnya terdapat group untuk mengecek kondisi login
// jika user yang login merupakan admin maka akan diarahkan ke AdminController
// jika user yang login merupakan manager maka akan diarahkan ke UserController 

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:2']], function () {
        Route::resource('manager', ManagerController::class);
    });
});

Route::get('/', function(){
    return view('welcome');
});
Route::get('/file-upload', [FileUploadController::class, 'fileUpload']);
Route::post('/file-upload', [FileUploadController::class, 'prosesFileUpload']);




// -------------------------------------------------------------------------------
// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::get('/kategori', [KategoriController::class, 'index']);

// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
// Route::put('/kategori/simpan_edit/{id}', [KategoriController::class, 'simpan_edit'])->name('kategori.simpan_edit');
// Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

//JOBSHEET 6 - m_user
// Route::get('/user/create', [UserController::class, 'create'])->name('/user/create');
// Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
// Route::get('/user', [UserController::class, 'index'])->name('user.index');
// Route::post('/user', [UserController::class, 'store']);
// Route::put('/user/{id}', [UserController::class, 'edit_simpan'])->name('/user/edit_simpan');
// Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

//JOBSHEET 6 - m_level
// Route::get('/level', [LevelController::class, 'index'])->name('level.index');
// Route::get('/level/create', [LevelController::class, 'create'])->name('/level/create');
// Route::post('/level', [LevelController::class, 'store']);
// Route::get('/level/edit/{id}', [LevelController::class, 'edit'])->name('/level/edit');
// Route::put('/level/{id}', [LevelController::class, 'edit_simpan'])->name('/level/edit_simpan');
// Route::put('/level/delete/{id}', [LevelController::class, 'delete'])->name('/level/delete');

// Route::resource('m_user', POSController::class);
