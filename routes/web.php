<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AmilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and will all be assigned
| to the "web" middleware group. Now create something great!
|
*/

// Route untuk halaman login dan proses login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang memerlukan autentikasi (pengguna harus masuk)
Route::middleware(['auth'])->group(function () {
    // Route untuk halaman dashboard
    Route::get('/dashboard', function () {
        return view('dashboard-admin');
    })->name('dashboard');
    Route::get('/amildashboard', [UserController::class, 'dashboard'])->name('user.dashboard');


    Route::put('/admin/amil/password-username/{id}', [
        AmilController::class,
        'updatePasswordUsername'
    ])->name('admin.amil.updatePasswordUsername');


    Route::get('/manage-amil', [AmilController::class, 'index'])->name('admin.amil');
    Route::get('/manage-amil/create', [AmilController::class, 'create'])->name('admin.amil.create');
    Route::post('/manage-amil', [AmilController::class, 'store'])->name('admin.amil.store');
    Route::put('/manage-amil/{id}', [AmilController::class, 'update'])->name('admin.amil.update');
    Route::delete('/manage-amil/{id}', [AmilController::class, 'destroy'])->name('admin.amil.delete');
    Route::put('/activate/{id}', [AmilController::class, 'activate'])->name('admin.amil.activate');
    Route::put('/deactivate/{id}', [AmilController::class, 'deactivate'])->name('admin.amil.deactivate');

    // kategori
    Route::get('/manage-kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/createKategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::delete('/deletekategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.delete');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');

});