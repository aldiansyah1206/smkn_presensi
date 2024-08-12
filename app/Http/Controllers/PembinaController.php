<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;

class PembinaController extends Controller
{
    public function index()
    {
        // Mendapatkan Pembina yang sedang login
        $pembina = Auth::user();

        // Mendapatkan kegiatan yang dikelola oleh pembina
        $kegiatan = Kegiatan::where('pembina_id', $pembina->id)->with('siswa.user')->first();

        // Mengambil siswa yang terdaftar dalam kegiatan yang dikelola pembina
        $siswa = $kegiatan ? $kegiatan->siswa : collect();

        return view('pembina.kegiatan.index', compact('kegiatan', 'siswa'));
    }
}
