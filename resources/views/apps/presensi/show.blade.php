@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Presensi untuk Kegiatan: {{ $kegiatan->name }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Siswa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presensi as $presen)
                @foreach($presen->daftar_siswa as $siswa_id)
                    @php
                        $siswa = \App\Models\Siswa::find($siswa_id);
                    @endphp
                    <tr>
                        <td>{{ $presen->tanggal }}</td>
                        <td>{{ $siswa->name }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
