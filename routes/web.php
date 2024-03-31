<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

Route::get('/', function () {
    return view('welcome');
});

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

// //JOBSHEET 6 - m_user
// Route::get('/user/create', [UserController::class, 'create'])->name('/user/create');
// Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
// Route::get('/user', [UserController::class, 'index'])->name('user.index');
// Route::post('/user', [UserController::class, 'store']);
// Route::put('/user/{id}', [UserController::class, 'edit_simpan'])->name('/user/edit_simpan');
// Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

// //JOBSHEET 6 - m_level
// Route::get('/level', [LevelController::class, 'index'])->name('level.index');
// Route::get('/level/create', [LevelController::class, 'create'])->name('/level/create');
// Route::post('/level', [LevelController::class, 'store']);
// Route::get('/level/edit/{id}', [LevelController::class, 'edit'])->name('/level/edit');
// Route::put('/level/{id}', [LevelController::class, 'edit_simpan'])->name('/level/edit_simpan');
// Route::put('/level/delete/{id}', [LevelController::class, 'delete'])->name('/level/delete');

// Route::resource('m_user', POSController::class);

//JOBSHEET 7
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});


