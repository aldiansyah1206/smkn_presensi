@extends('layouts.app')

@section('content')
<div class="col-md-12 p-4">
    <h2>Rekap Presensi Siswa</h2> 

    <!-- Filter bulan dan tombol ekspor -->
    <form action="{{ route('presensi.rekap') }}" method="get" class="mb-4">
        <div class="row align-items-end">
            <div class="col-md-3">
                <div class="form-group"> 
                    <select name="month" id="month" class="form-control" onchange="this.form.submit()">   
                        <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Februari</option>
                        <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>April</option>
                        <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>September</option>
                        <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>November</option>
                        <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('presensi.rekap', ['month' => $selectedMonth, 'export' => 'pdf']) }}" class="btn btn-success">
                    <i class="fas fa-file-pdf me-1"></i> Ekspor PDF
                </a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5>Presensi Siswa Bulan {{ \Carbon\Carbon::create()->month($selectedMonth)->translatedFormat('F') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($presensi->isEmpty())
                    <p class="text-center"><strong>Belum ada data presensi bulan ini.</strong></p>
                @else
                    <table class="table table-striped align-middle">
                        <thead class="table-dark">
                            <tr> 
                                <th>No</th>
                                <th>Nama Siswa</th>
                                @foreach ($dates as $date)
                                    <th>{{ \Carbon\Carbon::parse($date)->translatedFormat('d F') }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $index => $s)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $s->user->name }}</td>
                                    @foreach ($dates as $date)
                                        <td>
                                            @php
                                                $isPresent = '✘'; // Default to absent
                                                if ($s->presensi) {
                                                    foreach ($s->presensi as $presensiItem) {
                                                        if (\Carbon\Carbon::parse($presensiItem->pivot->tanggal)->isSameDay($date)) {
                                                            $isPresent = '✔'; // Mark as present
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            {{ $isPresent }}
                                        </td>
                                    @endforeach
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .btn-success:hover { background-color: #218838; border-color: #1e7e34; }
    .card { transition: transform 0.2s ease; }
    .card:hover { transform: translateY(0px); }
</style>