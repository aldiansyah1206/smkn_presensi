<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Siswa</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th>
                <th>Kegiatan</th>
                <th>No HP</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $index => $s)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->user->name }}</td>
                    <td>{{ $s->kelas->name }}</td>
                    <td>{{ $s->jurusan->name }}</td>
                    <td>{{ $s->jenis_kelamin }}</td> 
                    <td>{{ $s->kegiatan->name}}</td> 
                    <td>{{ $s->no_hp }}</td>
                    <td>{{ $s->alamat }}</td> 
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada siswa yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>