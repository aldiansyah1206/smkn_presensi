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
      // Validasi input
      $request->validate([
          'foto_selfie' => 'required', // Data Base64
          'status' => 'required|in:masuk,alpa',
      ]);

      $siswa = Auth::user()->siswa; // Ambil data siswa yang login
      $kegiatan = $siswa->kegiatan; // Ambil kegiatan siswa

      // Validasi apakah siswa terdaftar di kegiatan
      if (!$kegiatan || $kegiatan->id !== $presensi->kegiatan_id) {
          return redirect()->route('siswa.presensimasuk')
              ->with('danger', 'Anda tidak terdaftar pada kegiatan ini.');
      }

      // Decode data Base64 menjadi gambar
      $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->foto_selfie), true);

      if (!$imageData) {
          return redirect()->route('siswa.presensimasuk')
              ->with('danger', 'Data foto tidak valid.');
      }

      // Cek presensi ganda
      $existingPresensi = PresensiSiswa::where('presensi_id', $presensi->id)
          ->where('siswa_id', $siswa->id)
          ->whereDate('tanggal', now()->toDateString())
          ->first();

      if ($existingPresensi) {
          return redirect()->route('siswa.presensimasuk')
              ->with('warning', 'Anda sudah melakukan presensi hari ini.');
      }

      // Simpan gambar ke storage
      $imageName = uniqid() . '.png';
      $imagePath = "presensi/masuk/$imageName";
      $upload = Storage::disk('public')->put($imagePath, $imageData);

      if (!$upload) {
          return redirect()->route('siswa.presensimasuk')
              ->with('danger', 'Gagal menyimpan foto. Silakan coba lagi.');
      }

      // Simpan data presensi di database
      PresensiSiswa::create([
          'presensi_id' => $presensi->id,
          'siswa_id' => $siswa->id,
          'tanggal' => now(),
          'foto_selfie' => $imagePath, // Hanya menyimpan path gambar
          'status' => $request->status,
      ]);

      return redirect()->route('siswa.presensimasuk')
          ->with('success', 'Presensi berhasil diisi.');
  }
  
}
