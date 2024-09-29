<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Kegiatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
    }

    // Method untuk menampilkan form pembuatan presensi
    public function create()
    {

    }

 
    public function store(Request $request)
    {
       
    }

    public function edit(Presensi $presensi)
    {
        $pembina = Auth::user(); // Mendapatkan pembina yang sedang login

        // Validasi bahwa presensi termasuk dalam kegiatan yang dikelola oleh pembina
        $kegiatan = $presensi->kegiatan;
        if ($kegiatan->pembina_id !== $pembina->id) {
            return redirect()->back()->withErrors(['error' => 'Anda tidak berhak mengedit presensi ini.']);
        }

        return view('presensi.edit', compact('presensi'));
    }

    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'jam_masuk' => 'nullable|date_format:H:i',
            'status' => 'nullable|string',
        ]);

        $pembina = Auth::user(); // Mendapatkan pembina yang sedang login

        // Validasi bahwa presensi termasuk dalam kegiatan yang dikelola oleh pembina
        $kegiatan = $presensi->kegiatan;
        if ($kegiatan->pembina_id !== $pembina->id) {
            return redirect()->back()->withErrors(['error' => 'Anda tidak berhak memperbarui presensi ini.']);
        }

        // Perbarui presensi
        $presensi->update([
            'jam_masuk' => $request->jam_masuk,
            'status' => $request->status,
        ]);

        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil diperbarui.');
    }

    public function destroy(Presensi $presensi)
    {
        $pembina = Auth::user(); // Mendapatkan pembina yang sedang login

        // Validasi bahwa presensi termasuk dalam kegiatan yang dikelola oleh pembina
        $kegiatan = $presensi->kegiatan;
        if ($kegiatan->pembina_id !== $pembina->id) {
            return redirect()->back()->withErrors(['error' => 'Anda tidak berhak menghapus presensi ini.']);
        }

        // Hapus presensi
        $presensi->delete();

        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil dihapus.');
    }
}


