<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Pembina;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
 

class PembinaController extends Controller
{
    public function index()
    {
        // Mendapatkan User yang sedang login
        $user = Auth::user();
        // Mendapatkan Pembina yang terkait dengan User yang login
        $pembina = Pembina::where('user_id', $user->id)->first();
            if (!$pembina) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai pembina.');
            }
    
        // Mendapatkan kegiatan yang dikelola oleh pembina
        $kegiatan = Kegiatan::where('pembina_id', $pembina->id)
            ->with(['siswa.user', 'siswa.kelas', 'siswa.jurusan', 'siswa.kegiatan'])
            ->get();
            if ($kegiatan->isEmpty()) {
                return view('pembina.kegiatan', ['kegiatan' => collect(), 'siswa' => collect()]);
            }
    
            // Mengurutkan siswa berdasarkan kegiatan
            $siswa = $kegiatan->flatMap->siswa->sortBy('user.name');
    
            return view('pembina.kegiatan', compact('kegiatan', 'siswa'));
    }
    
    public function exportPDF()
    {
        $pembina = Auth::user()->pembina;
        $kegiatan = $pembina->kegiatan()->whereHas('siswa')->get();
        $siswa = Siswa::whereHas('kegiatan', function($query) use ($kegiatan) {
            $query->whereIn('kegiatan.id', $kegiatan->pluck('id')->toArray());
        })->with(['user', 'kegiatan', 'kelas', 'jurusan'])->get();

        $pdf = PDF::loadView('pembina.siswaPdf', [
            'siswa' => $siswa,
            'kegiatan' => $kegiatan
        ]);

        return $pdf->download('daftar siswa.pdf');
    }

}
