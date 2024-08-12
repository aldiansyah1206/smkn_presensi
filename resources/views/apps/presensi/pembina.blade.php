@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Kelola Presensi Siswa</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $p)
                <tr>
                    <td>{{ $p->siswa->nama }}</td>
                    <td>{{ $p->kegiatan->nama }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->jam_masuk }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <form method="POST" action="{{ url('/presensi' . $p->id) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-control">
                                <option value="Hadir" @if($p->status == 'Hadir') selected @endif>Hadir</option>
                                <option value="Terlambat" @if($p->status == 'Terlambat') selected @endif>Terlambat</option>
                                <option value="Tidak Hadir" @if($p->status == 'Tidak Hadir') selected @endif>Tidak Hadir</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection