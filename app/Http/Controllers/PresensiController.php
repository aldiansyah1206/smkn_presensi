<?php

namespace App\Http\Controllers; 
use App\Models\Presensi;
use App\Models\Kegiatan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Date;
use Barryvdh\DomPDF\Facade\Pdf;

class PresensiController extends Controller
{ 
    public function index()
    {
        $pembina = Auth::user()->pembina;
        $presensi = Presensi::with(['kegiatan', 'presensiSiswa.siswa'])
            ->where('pembina_id', $pembina->id) 
            ->whereDate('tanggal', now()->toDateString())
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('pembina.presensi', compact('presensi'));
    }

    public function create()
    {
        $pembina = Auth::user()->pembina;
        $kegiatan = Kegiatan::where('pembina_id', $pembina->id)->get();

        return view('pembina.presensicreate', compact('kegiatan'));
    }

    public function store(Request $request)
    { 
        $pembina = Auth::user()->pembina;
        $validated = $request->validate([
            'tanggal' => 'required|date|unique:presensi,tanggal,NULL,id,pembina_id,' . $pembina->id,
            'kegiatan_id' => [
                'required',
                'exists:kegiatan,id,pembina_id,' . $pembina->id,
                Rule::unique('presensi', 'kegiatan_id')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->tanggal);
                }),
            ],
        ]);
    
        Presensi::create([
            'pembina_id' => $pembina->id,
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal' => $request->tanggal,
        ]);
    
        return redirect()->route('presensi.index')->with('success', 'Presensi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pembina = Auth::user()->pembina;
        $presensi = Presensi::with(['kegiatan', 'presensiSiswa.siswa'])
            ->where('pembina_id', $pembina->id)
            ->findOrFail($id); 
        return view('pembina.presensi_detail', [
            'presensi' => $presensi,
            'presensiSiswa' => $presensi->presensiSiswa  
        ]);
    }

    public function destroy($id)
    {
        $pembina = Auth::user()->pembina;
        $presensi = Presensi::where('pembina_id', $pembina->id)
            ->findOrFail($id);

        $presensi->delete();

        return redirect()->route('presensi.history')->with('success', 'Presensi berhasil dihapus.');
    }

    public function history()
    {
        $pembina = Auth::user()->pembina;
        $presensi = Presensi::with(['kegiatan', 'presensiSiswa.siswa'])
        ->where('pembina_id', $pembina->id)
        ->orderBy('tanggal', 'desc')
        ->get();

        return view('pembina.presensi_history', compact('presensi'));
    }


    public function exportPDF()
    {
        $pembina = Auth::user()->pembina;
        $presensi = Presensi::with(['kegiatan', 'presensiSiswa.siswa'])
            ->where('pembina_id', $pembina->id)
            ->whereDate('tanggal', now()->toDateString())
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView('pembina.presensi_pdf', [
            'presensi' => $presensi,
        ]);

        return $pdf->download('daftar_presensi_' . now()->format('Ymd') . '.pdf');
    }

    public function rekap(Request $request)
    { 
        $pembina = Auth::user()->pembina;  
        $selectedMonth = request('month') ?? now()->month;
        $export = $request->input('export'); 
        $presensi = Presensi::with(['kegiatan', 'presensiSiswa.siswa.user'])
            ->where('pembina_id', $pembina->id)
            ->whereMonth('tanggal', $selectedMonth) 
            ->orderBy('tanggal', 'desc')
            ->get(); 

        $dates = $presensi->pluck('tanggal')->unique()->sort()->values(); 
        
        $siswa = Siswa::whereHas('kegiatan', function ($query) use ($pembina) {
            $query->where('pembina_id', $pembina->id);
        })->with(['user', 'presensi' => function ($query) use ($pembina, $selectedMonth) {
            $query->whereHas('presensiSiswa', function ($q) use ($pembina, $selectedMonth) {
                $q->where('pembina_id', $pembina->id)->whereMonth('tanggal', $selectedMonth);
            }); 
        }])->get();

        if ($export === 'pdf') {
            $pdf = Pdf::loadView('pembina.rekap_pdf', [
                'presensi' => $presensi,
                'dates' => $dates,
                'siswa' => $siswa,
                'selectedMonth' => $selectedMonth,
            ]);
            return $pdf->download('rekap_presensi_siswa_bulan_' . \Carbon\Carbon::create()->month($selectedMonth)->translatedFormat('M') . '_' . now()->format('Ymd_His') . '.pdf');
        }

        return view('pembina.presensirekap', compact('presensi', 'dates', 'siswa', 'selectedMonth'));
        }

}