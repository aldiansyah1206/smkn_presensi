<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use App\Models\Presensi;
use App\Models\PresensiSiswa;
use App\Models\Siswa;
use App\Models\Kegiatan;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{ 
    public function index()
    {
        // Mendapatkan pembina yang sedang login
        $pembina = Auth::user();
        
        // Mengambil data presensi dengan relasi siswa dan kegiatan
        $presensi = Presensi::with(['siswa', 'kegiatan'])
            ->where('pembina_id', $pembina->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Mengirim data presensi dan pembina ke view
        return view('pembina.presensi', compact('pembina', 'presensi'));
    }
    public function create()
    {
        // Mengambil data kegiatan jika diperlukan
        $pembina = Auth::user()->pembina;
        $kegiatan = Kegiatan::where('pembina_id', $pembina->id)->get();

        return view('pembina.presensicreate', compact('kegiatan','pembina'));
    }
    public function store(Request $request)
    { 
        $pembina = Auth::user()->pembina;;
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kegiatan_id' => 'required|exists:kegiatan,id',
        ]);
    
        // Tambahkan presensi baru
        Presensi::create([
            'pembina_id' => $pembina->id,  // pembina yang sedang login
            'kegiatan_id' => $validated['kegiatan_id'],
            'tanggal' => $validated['tanggal'],
        ]);
    
        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil ditambahkan.');
    }

}


