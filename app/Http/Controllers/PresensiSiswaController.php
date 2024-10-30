<?php

namespace App\Http\Controllers;
use App\Models\Presensi;
use App\Models\PresensiSiswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiSiswaController extends Controller
{
  public function create(Presensi $presensi)
  {
      return view('siswa.presensimasuk', compact('presensi'));
  }

  public function store(Request $request, Presensi $presensi)
  {
        $request->validate([
            'foto_selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:masuk,alpa',
        ]);

        // Memeriksa apakah ada gambar yang di-upload
        if ($request->hasFile('foto_selfie')) {
            $image = $request->file('foto_selfie');
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $upload = Storage::disk('public')->put("presensi/masuk/$image_name", file_get_contents($image));

            if ($upload) {
                $siswa = Auth::user()->siswa;
                $kegiatan = $siswa->kegiatan;

                if ($kegiatan && $kegiatan->id === $presensi->kegiatan_id) {
                    PresensiSiswa::create([
                        'presensi_id' => $presensi->id,
                        'siswa_id' => $siswa->id,
                        'tanggal' => now(),
                        'foto_selfie' => $image_name,
                        'status' => $request->status,
                    ]);

                    return redirect()->route('siswa.presensimasuk')->with('success', 'Presensi berhasil diisi.');
                } else {
                    return redirect()->route('siswa.presensimasuk')->with('danger', 'Anda tidak terdaftar pada kegiatan ini.');
                }
            } else {
                return redirect()->route('siswa.presensimasuk')->with('danger', 'Gagal mengunggah gambar.');
            }
        } else {
            return redirect()->route('siswa.presensimasuk')->with('danger', 'Gambar tidak ditemukan.');
        }
    }
}
