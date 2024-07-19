<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Penjadwalan;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            return [
                'id' => $event->id,
                'title' => $event->kegiatan->name,
                'start' => $event->tanggal_mulai,
                'end' => $event->tanggal_selesai,
                'kegiatan' => $event->kegiatan
            ];
        });
    
        return view('apps.penjadwalan.index', [
            "penjadwalan" => $penjadwalan->toJson(),
            "kegiatan" => Kegiatan::all()
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

        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
        // Create the initial event
        Penjadwalan::create($request->all());

        // Create recurring events for the next 3 weeks
        for ($i = 1; $i <= 3; $i++) {
            $newStartDate = $tanggalMulai->copy()->addWeeks($i);
            $newEndDate = $tanggalSelesai->copy()->addWeeks($i);

            Penjadwalan::create([
                'kegiatan_id' => $request->kegiatan_id,
                'tanggal_mulai' => $newStartDate,
                'tanggal_selesai' => $newEndDate,
            ]);
        }

        return redirect()->route('apps.penjadwalan.index')->with('success', 'Jadwal berhasil ditambahkan dan akan berulang setiap minggu.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Penjadwalan $penjadwalan)
    {
        return view('apps.penjadwalan.show', [
            "penjadwalan" => $penjadwalan,
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
    public function destroy(Penjadwalan $penjadwalan)
    {
        $penjadwalan->delete();
    
        return redirect()->route('apps.penjadwalan.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}  