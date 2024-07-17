<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/logout', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('apps.kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('apps.kelas.create');
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('apps.kelas.store');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('apps.kelas.edit'); 
    Route::patch('/kelas/{kelas}', [KelasController::class, 'update'])->name('apps.kelas.update'); 
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('apps.kelas.destroy'); 
    // jurusan
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('apps.jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('apps.jurusan.create');
    Route::post('/jurusan/store', [JurusanController::class, 'store'])->name('apps.jurusan.store');
    Route::get('/jurusan/{jurusan}/edit', [JurusanController::class, 'edit'])->name('apps.jurusan.edit'); 
    Route::patch('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('apps.jurusan.update'); 
    Route::delete('/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('apps.jurusan.destroy'); 
    // pembina

    // siswa

    // kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('apps.kegiatan.index');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('apps.kegiatan.create');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('apps.kegiatan.store');
    Route::get('/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('apps.kegiatan.edit'); 
    Route::patch('/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('apps.kegiatan.update'); 
    Route::delete('/kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('apps.kegiatan.destroy'); 
});

require __DIR__.'/auth.php';
