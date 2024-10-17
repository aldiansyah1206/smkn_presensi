<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use App\Models\Presensi;
use App\Models\Siswa;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{ 
    public function index()
    {
        $user = Auth::user();
        $pembina = Pembina::where('user_id', $user->id)->first();

        if (!$pembina) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $kegiatan = $pembina->kegiatan;
        $presensiList = Presensi::where('kegiatan_id', $kegiatan->id)->get();

        return view('pembina.presensi', compact('pembina', 'kegiatan', 'presensiList'));
    }
    public function create()
    {
        $user = Auth::user();
        $pembina = Pembina::where('user_id', $user->id)->first();

        if (!$pembina) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $kegiatan = $pembina->kegiatan;

        return view('pembina.presensicreate', compact('pembina', 'kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        $user = Auth::user();
        $pembina = Pembina::where('user_id', $user->id)->first();

        if (!$pembina) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        Presensi::create([
            'kegiatan_id' => $pembina->kegiatan->id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil dibuat.');
    }


    public function siswaIndex()
    {
        return view('siswa.presensisiswa');
    }
    public function siswaMasuk()
    {
        return view('siswa.siswamasuk');
    }
    public function storeSignIn(Request $request)
    {
        // Memeriksa apakah ada gambar yang di-upload
        if ($request->image) {
            // Mengambil string 
            $base64string = $request->image;
            
            // Menghapus prefix data 
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64string));
            
            // Membuat nama file gambar dengan id unik
            $image_name = uniqid() . '.jpeg';
            
            // Menyimpan gambar ke dalam penyimpanan lokal di folder 'public/absensi/masuk'
            $upload = Storage::disk('local')->put("public/presensi/masuk/$image_name", $image);
            
            // Jika upload berhasil, redirect dengan pesan sukses
            if ($upload) {
                return redirect()->route('siswa.siswamasuk')->with('success', 'Upload Berhasil');
            } else {
                // Jika upload gagal, redirect dengan pesan gagal
                return redirect()->route('siswa.siswamasuk')->with('danger', 'Upload Gagal');
            }
        } else {
            // Jika gambar tidak ada, redirect dengan pesan gagal
            return redirect()->route('siswa.siswamasuk')->with('danger', 'Gambar tidak ada');
        }
    }

}


