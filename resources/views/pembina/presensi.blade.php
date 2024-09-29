<!DOCTYPE html>
<html>
<head>
    <title>Presensi Pembina</title>
    <!-- Tambahkan CSS atau JS jika perlu -->
</head>
<body>
    <h1>Presensi untuk Kegiatan</h1>

    <h2>Data Pembina</h2>
    <p>Nama: {{ $pembina->name }}</p>
    <p>Email: {{ $pembina->email }}</p>

    <h2>Kegiatan yang Dikelola</h2>
    <ul>
        @foreach($kegiatan as $keg)
            <li>{{ $keg->name }}</li>
        @endforeach
    </ul>

    <h2>Daftar Presensi</h2>
    @if($presensi->isEmpty())
        <p>Tidak ada presensi yang dibuat untuk kegiatan ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presensi as $presen)
                    <tr>
                        <td>{{ $presen->siswa->name }}</td>
                        <td>{{ $presen->kegiatan->name }}</td>
                        <td>{{ $presen->tanggal }}</td>
                        <td>{{ $presen->jam_masuk }}</td>
                        <td>{{ $presen->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
