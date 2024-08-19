<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Penjadwalan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Penjadwalan::whereDate('tanggal_mulai', '>=', $request->start)
                        ->whereDate('tanggal_selesai', '<=', $request->end)
                        ->get(['id', 'kegiatan_id', 'tanggal_mulai as start', 'tanggal_selesai as end']);
            return response()->json($data);
        }
    
        $penjadwalan = Penjadwalan::with('kegiatan')->get()->map(function ($event) {
            // Konversi string ke objek Carbon jika diperlukan
            $tanggalMulai = Carbon::parse($event->tanggal_mulai);
            $tanggalSelesai = Carbon::parse($event->tanggal_selesai);
        
            return [
                'id' => $event->id,
                'title' => $event->kegiatan->name,
                'start' => $tanggalMulai->format('Y-m-d'), // Format hanya tanggal
                'end' => $tanggalSelesai->format('Y-m-d'), // Format hanya tanggal
                'kegiatan' => $event->kegiatan
            ];
        });
        
         
        return view('apps.penjadwalan.index', [
            "penjadwalan" => $penjadwalan->toJson(),
            "kegiatan" => Kegiatan::all()
        ]);
    }
    public function indexForUsers()
    {
        $penjadwalan = Penjadwalan::with('kegiatan')->get()->map(function ($event) {
            $tanggalMulai = Carbon::parse($event->tanggal_mulai);
            $tanggalSelesai = Carbon::parse($event->tanggal_selesai);
    
            return [
                'id' => $event->id,
                'title' => $event->kegiatan->name,
                'start' => $tanggalMulai->format('Y-m-d'),
                'end' => $tanggalSelesai->format('Y-m-d'),
                'kegiatan' => $event->kegiatan
            ];
        });
    
        return view('apps.penjadwalan.jadwaluser', [
            "penjadwalan" => $penjadwalan->toJson(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('apps.penjadwalan.create', [
            "kegiatan" => $kegiatan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Parse tanggal untuk perbandingan
        $tanggalMulai = Carbon::parse($request->tanggal_mulai)->format('Y-m-d');
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai)->format('Y-m-d');

        // Cek apakah ada kegiatan dengan ID yang sama pada tanggal yang sama
        $existingEvent = Penjadwalan::where('kegiatan_id', $request->kegiatan_id)
                                    ->whereDate('tanggal_mulai', $tanggalMulai)
                                    ->whereDate('tanggal_selesai', $tanggalSelesai)
                                    ->first();

        if ($existingEvent) {
            return redirect()->back()->with('error', 'Kegiatan dengan ID ini sudah ada pada tanggal tersebut.');
        }

        // Simpan kegiatan baru
        Penjadwalan::create($request->all());

        return redirect()->route('apps.penjadwalan.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Penjadwalan $penjadwalan)
    {     
        $kegiatan = Kegiatan::all();

        return view('apps.penjadwalan.index', [
            'penjadwalan' => $penjadwalan->toJson(),
            'kegiatan' => $kegiatan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        $kegiatan = Kegiatan::all();
        return view('apps.penjadwalan.edit', [
            "penjadwalan" => $penjadwalan,
            "kegiatan" => $kegiatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjadwalan $penjadwalan)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
    
        // Check if there is already an event on the same date, excluding the current event
        $existingEvent = Penjadwalan::where('id', '!=', $penjadwalan->id)
                                ->where(function($query) use ($request) {
                                    $query->whereDate('tanggal_mulai', $request->tanggal_mulai)
                                          ->orWhereDate('tanggal_selesai', $request->tanggal_selesai);
                                })->first();
        
        if ($existingEvent) {
            return redirect()->route('apps.penjadwalan.index')->with('error', 'Nama Kegiatan sudah ada ditanggal ini.');
        }
    
        $penjadwalan->update($request->all());
        return redirect()->route('apps.penjadwalan.index')->with('success', 'Jadwal berhasil diupdate');
    }
        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari kegiatan berdasarkan ID
            $penjadwalan = Penjadwalan::findOrFail($id);
            // Hapus kegiatan
            $penjadwalan->delete();
            return response()->json(['success' => 'Kegiatan berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            // Log kesalahan
            Log::error('Gagal menghapus kegiatan: ' . $e->getMessage());

            return response()->json(['message' => 'Gagal menghapus kegiatan.'], 500);
        }
    }
}  