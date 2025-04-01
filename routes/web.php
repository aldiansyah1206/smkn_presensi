<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\PembinaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// login
Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Rote role admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
    Route::get('/userspembina', [AdminUserController::class, 'indexPembina'])->name('apps.users.indexPembina');
    Route::get('/userspembina/create', [AdminUserController::class, 'createPembina'])->name('apps.users.createPembina');
    Route::post('/userspembina/store', [AdminUserController::class, 'storePembina'])->name('apps.users.storePembina');
    Route::get('/userspembina/{userspembina}/edit', [AdminUserController::class, 'editPembina'])->name('apps.users.editPembina'); 
    Route::patch('/userspembina/{id}', [AdminUserController::class, 'updatePembina'])->name('apps.users.updatePembina'); 
    Route::delete('/userspembina/{userspembina}', [AdminUserController::class, 'destroyPembina'])->name('apps.users.destroyPembina'); 
    // siswa
    Route::get('/userssiswa', [AdminUserController::class, 'indexSiswa'])->name('apps.users.indexSiswa');
    Route::get('/userssiswa/create', [AdminUserController::class, 'createSiswa'])->name('apps.users.createSiswa');
    Route::post('/userssiswa/store', [AdminUserController::class, 'storeSiswa'])->name('apps.users.storeSiswa');
    Route::get('/userssiswa/{userssiswa}/edit', [AdminUserController::class, 'editSiswa'])->name('apps.users.editSiswa'); 
    Route::patch('/userssiswa/{id}', [AdminUserController::class, 'updateSiswa'])->name('apps.users.updateSiswa'); 
    Route::delete('/userssiswa/{userssiswa}', [AdminUserController::class, 'destroySiswa'])->name('apps.users.destroySiswa'); 
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

Route::middleware(['auth', 'role:pembina'])->group(function () {
    Route::get('/dashboardpembina', [DashboardController::class, 'indexPembina'])->name('dashboardpembina');
    Route::get('/pembina/kegiatan', [PembinaController::class, 'index'])->name('pembina.kegiatan.index');
    Route::get('/pembina/siswaPdf', [PembinaController::class, 'exportPDF'])->name('pembina.siswaPdf');
    Route::get('/presensi/export-pdf', [PresensiController::class, 'exportPDF'])->name('presensi.exportPDF'); 
    Route::delete('/pembina/presensi/siswa/{id}', [PresensiSiswaController::class, 'destroy'])->name('pembina.presensi.siswa.delete');
    Route::get('/presensi/history', [PresensiController::class, 'history'])->name('presensi.history');  
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap'); 
    Route::resource('presensi', PresensiController::class); 
    Route::get('/jadwalpembina', [PenjadwalanController::class, 'indexjadwalpembina'])->name('apps.penjadwalan.jadwalpembina');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboardsiswa', function () {return view('dashboardsiswa');})->name('dashboardsiswa'); 
    Route::get('/jadwalsiswa', [PenjadwalanController::class, 'indexjadwalsiswa'])->name('apps.penjadwalan.jadwalsiswa');
    Route::get('/siswa/presensi', [PresensiSiswaController::class, 'index'])->name('siswa.presensi');
    Route::post('/siswa/presensi/store', [PresensiSiswaController::class, 'store'])->name('siswa.presensistore');
    Route::get('/siswa/presensi/history', [PresensiSiswaController::class, 'history'])->name('siswa.presensi.history');
 
});
 
require __DIR__.'/auth.php';
