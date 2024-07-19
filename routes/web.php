<?php

use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
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
// Rote role admin
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
    Route::get('/pembina', [PembinaController::class, 'index'])->name('apps.pembina.index');
    Route::get('/pembina/create', [PembinaController::class, 'create'])->name('apps.pembina.create');
    Route::post('/pembina/store', [PembinaController::class, 'store'])->name('apps.pembina.store');
    Route::get('/pembina/{pembina}/edit', [PembinaController::class, 'edit'])->name('apps.pembina.edit'); 
    Route::patch('/pembina/{pembina}', [PembinaController::class, 'update'])->name('apps.pembina.update'); 
    Route::delete('/pembina/{pembina}', [PembinaController::class, 'destroy'])->name('apps.pembina.destroy'); 
    // siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('apps.siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('apps.siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('apps.siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('apps.siswa.edit'); 
    Route::patch('/siswa/{siswa}', [SiswaController::class, 'update'])->name('apps.siswa.update'); 
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('apps.siswa.destroy'); 
    // kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('apps.kegiatan.index');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('apps.kegiatan.create');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('apps.kegiatan.store');
    Route::get('/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('apps.kegiatan.edit'); 
    Route::patch('/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('apps.kegiatan.update'); 
    Route::delete('/kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('apps.kegiatan.destroy'); 
    // penjadwalan
    Route::get('/penjadwalan', [PenjadwalanController::class, 'index'])->name('apps.penjadwalan.index');
    Route::get('/penjadwalan/create', [PenjadwalanController::class, 'create'])->name('apps.penjadwalan.create');
    Route::post('/penjadwalan/store', [PenjadwalanController::class, 'store'])->name('apps.penjadwalan.store');
    Route::get('/penjadwalan/{penjadwalan}/edit', [PenjadwalanController::class, 'edit'])->name('apps.penjadwalan.edit'); 
    Route::patch('/penjadwalan/{penjadwalan}', [PenjadwalanController::class, 'update'])->name('apps.penjadwalan.update'); 
    Route::delete('/penjadwalan/{penjadwalan}', [PenjadwalanController::class, 'destroy'])->name('apps.penjadwalan.destroy'); 
});

require __DIR__.'/auth.php';
