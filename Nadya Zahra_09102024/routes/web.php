<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// role akses --> admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/buku', [AdminController::class, 'buku'])->name('admin.buku');
    Route::get('/admin/buku-det', [AdminController::class, 'buku_det'])->name('admin.buku-det');
    Route::get('/admin/tambah-buku', [AdminController::class, 'tambah_buku'])->name('admin.tambah-buku');
    Route::post('/admin/submit-buku', [AdminController::class, 'buku_store'])->name('admin.submit-buku');
    Route::get('/admin/get-data', [AdminController::class, 'get_data'])->name('admin.get-data');
});

// role akses --> user
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/home', [UserController::class, 'dashboard'])->name('user.home');
});

// setelah user berhasil login
Route::get('/home', [HomeController::class, 'home'])->name('home');
