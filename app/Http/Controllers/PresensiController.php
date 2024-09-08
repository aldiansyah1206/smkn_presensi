<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Kegiatan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $pembina = auth()->user(); // Mendapatkan pembina yang sedang login
        $kegiatan = $pembina->kegiatan; // Mengambil kegiatan yang ditangani oleh pembina
        $tanggalHariIni = now()->format('Y-m-d'); // Mendapatkan tanggal hari ini

         $kegiatan = Kegiatan::where('pembina_id', $pembina->id)
            ->with(['siswa.user', 'siswa.kelas', 'siswa.jurusan'])
            ->get();
            if ($kegiatan->isEmpty()) {
                return view('pembina.presensisiswa', ['kegiatan' => collect(), 'siswa' => collect()]);
            }
    
            // Mengurutkan siswa berdasarkan kegiatan
            $siswa = $kegiatan->flatMap->siswa->sortBy('user.name');
        return view('pembina.presensisiswa', compact('kegiatan', 'siswa','tanggalHariIni'));
    }

    public function create()
    {
        $pembina = Auth::user()->pembina;
        $kegiatan = Kegiatan::where('id', $pembina->kegiatan_id)->first();
        $siswa = Siswa::where('kegiatan_id', $kegiatan->id)->get();
        return view('pembina.presensisiswa', compact('kegiatan', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'siswa_id' => 'required|exists:siswa,id',
            'kegiatan_id' => 'required|exists:kegiatan,id',
        ]);
    
        $presensi = new Presensi();
        $presensi->tanggal = $request->tanggal;
        $presensi->siswa_id = $request->siswa_id;
        $presensi->kegiatan_id = $request->kegiatan_id;
        $presensi->pembina_id = auth()->user()->id; // Atur ID pembina saat ini
        $presensi->save();
    
        return redirect()->back()->with('success', 'Presensi berhasil ditambahkan.');
    }

    public function edit(Presensi $presensi)
    {
        $pembina = Auth::user()->pembina;
        if ($presensi->pembina_id !== $pembina->id) {
            abort(403);
        }
        return view('apps.presensi.edit', compact('presensi'));
    }

    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'status' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $pembina = Auth::user()->pembina;
        if ($presensi->pembina_id !== $pembina->id) {
            abort(403);
        }

        $presensi->update([
            'jam_masuk' => $request->jam_masuk,
            'status' => $request->status,
        ]);

        return redirect()->route('apps.presensi.index')->with('success', 'Presensi berhasil diperbarui');
    }

    public function destroy(Presensi $presensi)
    {
        $pembina = Auth::user()->pembina;
        if ($presensi->pembina_id !== $pembina->id) {
            abort(403);
        }

        $presensi->delete();

        return redirect()->route('apps.presensi.index')->with('success', 'Presensi berhasil dihapus');
    }
}


