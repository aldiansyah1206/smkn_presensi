<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembina;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Kegiatan;
class DashboardController extends Controller
{
    public function index()
    {
        $countPembina = Pembina::count();
        $countSiswa = Siswa::count();
        $countKelas = Kelas::count();
        $countJurusan = Jurusan::count();
        $countKegiatan = Kegiatan::count();

        return view('dashboard', compact('countPembina', 'countSiswa','countKelas', 'countJurusan', 'countKegiatan'));
    }
    public function indexPembina()
    {  
        $pembina = auth()->user(); // Mendapatkan pembina yang sedang login
        $kegiatan = $pembina->kegiatan; // Mendapatkan kegiatan yang dikelola pembina

        // Membuat array untuk menyimpan count siswa
        $countSiswa = [];

        if ($kegiatan && $kegiatan->isNotEmpty()) { // Cek apakah pembina memiliki kegiatan
            foreach ($kegiatan as $keg) {
                // Menghitung jumlah siswa yang mengikuti kegiatan ini
                $countSiswa[$keg->name] = Siswa::where('kegiatan_id', $keg->id)->count();
            }
        } else {
            $countSiswa = null; // Set countSiswa to null if no activities found
        }

        return view('dashboardpembina', compact('countSiswa'));
    }
}
