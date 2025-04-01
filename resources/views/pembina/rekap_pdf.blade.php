<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rekap Presensi Siswa</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/DejaVuSans.ttf') }}") format('truetype');
        }
        body { font-family: 'DejaVu Sans', sans-serif; margin: 20px; }
        h1 { color: #007bff; text-align: center; margin-bottom: 20px; }
        .header { margin-bottom: 20px; font-size: 14px; text-align: center; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: center; }
        th { background-color: #343a40; color: white; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .check { color: green; font-size: 16px; }
        .cross { color: red; font-size: 16px; }
    </style>
</head>
<body> 
    <h1>Rekap Presensi Siswa Bulan {{ \Carbon\Carbon::create()->month($selectedMonth)->translatedFormat('F') }}</h1>
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
                                <td style="text-align: left;">{{ $s->user->name }}</td>
                                @foreach ($dates as $date)
                                <td>
                                    @php
                                        $isPresent = "<span class='cross'>✘</span>"; // Default absen
                                        if ($s->presensi) {
                                            foreach ($s->presensi as $presensiItem) {
                                                if (\Carbon\Carbon::parse($presensiItem->pivot->tanggal)->isSameDay($date)) {
                                                    $isPresent = "<span class='check'>✔</span>"; // Hadir
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    {!! $isPresent !!}
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif 
        </div>
    </div>
</body> 
</html>
