<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\PresensiSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiSiswaController extends Controller
{
    public function index()
    {  
        $siswa = Auth::user()->siswa; // Mendapatkan data siswa yang sedang login   

        // Ambil presensi berdasarkan kegiatan siswa untuk hari ini
        $presensi = Presensi::where('kegiatan_id', $siswa->kegiatan_id)
            ->whereDate('tanggal', now()->toDateString())
            ->orderBy('tanggal', 'desc')
            ->first();

        if (!$presensi) {
            return redirect()->route('dashboardsiswa')->with('info', 'Belum ada presensi untuk hari ini.');
        }
        
        // Cek apakah siswa sudah presensi
        $sudahPresensi = PresensiSiswa::where('presensi_id', $presensi->id)
            ->where('siswa_id', $siswa->id)
            ->exists();
        
        if ($sudahPresensi) {
            return redirect()->route('dashboardsiswa')->with('error', 'Anda sudah melakukan presensi hari ini.');
        }

        return view('siswa.presensimasuk', compact('presensi'));
    }

    public function store(Request $request)
    { 
        $siswa = Auth::user()->siswa;

        $presensi = Presensi::where('kegiatan_id', $siswa->kegiatan_id)
            ->whereDate('tanggal', now()->toDateString())
            ->firstOrFail();
        if (!$presensi) {
                return redirect()->back()->with('error', 'Presensi tidak ditemukan untuk hari ini.');
            }
            
        $validated = $request->validate([
            'foto_selfie' => 'required|string',
        ]);
     
        $fotoSelfiePath = $this->simpanFotoSelfie($validated['foto_selfie']);
    
        PresensiSiswa::create([
            'presensi_id' => $presensi->id,
            'siswa_id' => $siswa->id,
            'foto_selfie' => $fotoSelfiePath,
            'tanggal' => $presensi->tanggal,
            'waktu' => now()->toTimeString(),
        ]);
    
        $presensiHistory = PresensiSiswa::where('siswa_id', $siswa->id)
        ->orderBy('tanggal', 'desc')
        ->paginate(2);

        // Memuat relasi kegiatan
        $siswa->load('kegiatan');

        return redirect()->route('siswa.presensi.history')->with(compact('presensiHistory', 'siswa'));
    }

    public function destroy($id)
    { 
        $presensiSiswa = PresensiSiswa::with('presensi.kegiatan')->findOrFail($id); 
        $pembina = Auth::user()->pembina; 
        $kegiatan = $presensiSiswa->presensi->kegiatan;
        if ($kegiatan->pembina_id !== $pembina->id) {   
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        } 
        if ($presensiSiswa->foto_selfie) {
            Storage::delete($presensiSiswa->foto_selfie);
        } 
        $presensiSiswa->delete();
 
        return redirect()->back()->with('success', 'Data presensi siswa berhasil dihapus.');
    }
    public function history()
    {
        $siswa = Auth::user()->siswa;

        $presensiHistory = PresensiSiswa::select('presensi_siswa.*', 'kegiatan.name')  
            ->where('presensi_siswa.siswa_id', $siswa->id)
            ->join('presensi', 'presensi_siswa.presensi_id', '=', 'presensi.id')  
            ->join('kegiatan', 'presensi.kegiatan_id', '=', 'kegiatan.id')  
            ->orderBy('presensi_siswa.tanggal', 'desc')
            ->paginate(2);
    
        // Memuat relasi kegiatan dari siswa
        $siswa->load('kegiatan');
    
        return view('siswa.presensi-history', compact('presensiHistory', 'siswa'));
    }

    private function simpanFotoSelfie($fotoSelfieBase64)
    {
        $folderPath = 'public/foto_selfie/';  
        $image_parts = explode(";base64,", $fotoSelfieBase64);  
        $image_type_aux = explode("image/", $image_parts[0]);  
        $image_type = $image_type_aux[1];  
        $image_base64 = base64_decode($image_parts[1]);  

        $fileName = uniqid() . '.' . $image_type;
        Storage::put($folderPath . $fileName, $image_base64);

        return $folderPath . $fileName;  
    }
}