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
        $pembina = Auth::user()->pembina;
        $presensi = Presensi::where('pembina_id', $pembina->id)->get();
        return view('apps.presensi.index', compact('presensi'));
    }

    public function create()
    {
        $pembina = Auth::user()->pembina;
        $kegiatan = Kegiatan::where('id', $pembina->kegiatan_id)->first();
        $siswa = Siswa::where('kegiatan_id', $kegiatan->id)->get();
        return view('apps.presensi.create', compact('kegiatan', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'status' => 'required|in:hadir,izin,sakit,alpa',
        ]);

        $pembina = Auth::user()->pembina;

        Presensi::create([
            'siswa_id' => $request->siswa_id,
            'kegiatan_id' => $pembina->kegiatan_id,
            'pembina_id' => $pembina->id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'status' => $request->status,
        ]);

        return redirect()->route('apps.presensi.index')->with('success', 'Presensi berhasil ditambahkan');
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


