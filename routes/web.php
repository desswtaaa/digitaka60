<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| LANDING

*/
Route::get('/', function () {
    return view('landing');
});

/*
|--------------------------------------------------------------------------
| REDIRECT SETELAH LOGIN (PENTING 🔥)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('siswa.dashboard');
    }
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/books', [AdminController::class, 'books'])
        ->name('admin.books');
    Route::post('/books', [AdminController::class, 'storeBook'])
        ->name('admin.books.store');
    Route::put('/books/{id}', [AdminController::class, 'updateBook'])
        ->name('admin.books.update');
    Route::delete('/books/{id}', [AdminController::class, 'destroyBook'])
        ->name('admin.books.destroy');

    Route::get('/categories', [AdminController::class, 'categories'])
        ->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])
        ->name('admin.categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])
        ->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])
        ->name('admin.categories.destroy');

    Route::get('/anggota', [AdminController::class, 'anggota'])
        ->name('admin.anggota');
    Route::post('/anggota', [AdminController::class, 'storeAnggota'])
        ->name('admin.anggota.store');
    Route::put('/anggota/{id}', [AdminController::class, 'updateAnggota'])
        ->name('admin.anggota.update');
    Route::delete('/anggota/{id}', [AdminController::class, 'destroyAnggota'])
        ->name('admin.anggota.destroy');

    Route::get('/peminjaman', [AdminController::class, 'peminjaman'])
        ->name('admin.peminjaman');
    Route::post('/peminjaman', [AdminController::class, 'storePeminjaman'])
        ->name('admin.peminjaman.store');
    Route::put('/peminjaman/{id}', [AdminController::class, 'updatePeminjaman'])
        ->name('admin.peminjaman.update');
    Route::delete('/peminjaman/{id}', [AdminController::class, 'destroyPeminjaman'])
        ->name('admin.peminjaman.destroy');
});


/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('siswa')->group(function () {

    Route::get('/dashboard', [SiswaController::class, 'index'])
        ->name('siswa.dashboard');

    Route::get('/pinjam', [SiswaController::class, 'pinjam'])
        ->name('siswa.pinjam');
    Route::post('/pinjam', [SiswaController::class, 'storePinjam'])
        ->name('siswa.pinjam.store');

    Route::get('/kembali', [SiswaController::class, 'kembali'])
        ->name('siswa.kembali');
    Route::put('/kembali/{id}', [SiswaController::class, 'storeKembali'])
        ->name('siswa.kembali.store');

    Route::get('/riwayat', [SiswaController::class, 'riwayat'])
        ->name('siswa.riwayat');
});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});


require __DIR__.'/auth.php';
