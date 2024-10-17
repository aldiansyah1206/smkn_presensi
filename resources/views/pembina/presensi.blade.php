@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sistem Presensi</h1>
    <div class="mb-3">
        <a href="{{ route('presensi.create') }}" class="btn btn-primary">Tambah Presensi</a>
        <a href="#" class="btn btn-secondary">Export Data</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensiList as $presensi)
            <tr>
                <td>{{ $presensi->kegiatan->nama }}</td>
                <td>{{ $presensi->tanggal }}</td>
                <td>{{ $presensi->waktu }}</td>
                <td>{{ $presensi->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection