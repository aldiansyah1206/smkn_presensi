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
         // Ambil user yang login
        $user = auth()->user();

        // Pastikan user yang login adalah Pembina
        if (!$user->pembina) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai pembina.');
        }

        // Ambil data pembina
        $pembina = $user->pembina;

        // Ambil kegiatan yang dibina oleh pembina ini
        $kegiatan = Kegiatan::where('pembina_id', $pembina->id)->first();

        // Cek apakah kegiatan ada
        if ($kegiatan) {
            // Hitung jumlah siswa yang terdaftar pada kegiatan ini
            $countSiswaKegiatan = $kegiatan->siswa()->count();
        } else {
            $countSiswaKegiatan = 0;
        }

    return view('dashboardpembina', compact('countSiswaKegiatan' ));
    }
}
