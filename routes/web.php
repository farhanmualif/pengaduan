<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapiController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('user', AdminController::class);
    Route::get('/home', [AdminController::class, 'index']);
    Route::get('/profile/{id}', [AdminController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/table-user', [AdminController::class, 'tableUser'])->name('table-user');
    Route::get('/table-pengaduan', [PengaduanController::class, 'tablePengaduan'])->name('table-pengaduan');
    Route::get('/form-pengaduan', [PengaduanController::class, 'formPengaduan'])->name('form-pengaduan');

    Route::get('/table-pengaduan-ditanggapi/{id}', [TanggapiController::class, 'tablePengaduanDitanggapi'])->name('table-pengaduan-ditanggapi');

    Route::get('/form-update-pengaduan/{id}', [PengaduanController::class, 'formUpdatePengaduan'])->name('form-update-pengaduan');
    Route::resource('pengaduan', PengaduanController::class);
    Route::get('/form-update-user/{id}', [AdminController::class, 'formUpdateUser'])->name('form-update-user');
});

Route::middleware(['auth', 'user-access:Admin'])->group(function () {
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('/table-admin', [AdminController::class, 'table'])->name('table-admin');
    Route::resource('tanggapi', TanggapiController::class);
    Route::get('/tanggapi-pengaduan/{id}', [TanggapiController::class, 'formTanggapiPengaduan'])->name('form-update-user');
});
