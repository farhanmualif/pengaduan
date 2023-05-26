<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/table-user', [AdminController::class, 'tableUser'])->name('table-user');
    Route::get('/table-pengaduan', [PengaduanController::class, 'tablePengaduan'])->name('table-pengaduan');
    Route::get('/form-pengaduan', [PengaduanController::class, 'formPengaduan'])->name('form-pengaduan');
    Route::get('/form-update-pengaduan/{id}', [PengaduanController::class, 'formUpdatePengaduan'])->name('form-update-pengaduan');
    Route::resource('pengaduan', PengaduanController::class);
});

Route::middleware(['auth', 'user-access:Admin'])->group(function () {
    Route::get('/form-update-user/{id}', [AdminController::class, 'formUpdateUser'])->name('form-update-user');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::get('/table-admin', [AdminController::class, 'tableAdmin'])->name('table-admin');
});
