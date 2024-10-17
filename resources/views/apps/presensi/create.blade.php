@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Presensi Kegiatan {{ $kegiatan->nama }}</h1>
    <p>Tanggal: {{ now()->format('d F Y') }}</p>

    <form action="{{ route('presensi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
        <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Foto Selfie</th>
                    <th>Status Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan->siswa as $siswa)
                <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>
                        <input type="file" name="foto_selfie[{{ $siswa->id }}]" accept="image/*" capture="user" class="form-control-file">
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="presensi[{{ $siswa->id }}]" id="hadir{{ $siswa->id }}" value="1">
                            <label class="form-check-label" for="hadir{{ $siswa->id }}">Hadir</label>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan Presensi</button>
    </form>
</div>
@endsection