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
        $pembinaId = auth()->user()->id; 

        // Ambil kegiatan yang dibina oleh pembina ini
        $kegiatan = Kegiatan::where('pembina_id', $pembinaId)->first();
    
        if ($kegiatan) {
            // Hitung jumlah siswa yang terkait dengan kegiatan ini
            $countSiswaKegiatan = $kegiatan->siswa()->count();
        } else {
            $countSiswaKegiatan = 0;
        }

     

    return view('dashboardpembina', compact('countSiswaKegiatan' ));
    }
}
