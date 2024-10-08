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
        $pembina = auth()->user(); // Mendapatkan pembina yang sedang login
        $kegiatan = $pembina->kegiatan; // Mengambil kegiatan yang ditangani oleh pembina
        $tanggalHariIni = now()->format('Y-m-d'); // Mendapatkan tanggal hari ini

         $kegiatan = Kegiatan::where('pembina_id', $pembina->id)

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

        return view('pembina.presensisiswa', compact('kegiatan', 'siswa','tanggalHariIni'));


    }

    // Method untuk menampilkan form pembuatan presensi
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


