@extends('layouts.app')

@section('content')
<div class="col-md-12 p-4">
    <h2>Presensi Kegiatan</h2>
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="{{ route('presensi.create') }}" class="btn btn-success me-3 mb-2"><i class="fas fa-plus"></i> Tambah Presensi</a> 
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5>Siswa Yang Telah Mengisi Presensi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr> 
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                            <th>Nama Siswa</th>
                            <th>Foto Selfie</th>
                            <th>Waktu Presensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presensi as $pre)
                            @foreach ($pre->presensiSiswa as $presensiSiswa)
                                <tr>  
                                    <td>{{ \Carbon\Carbon::parse($pre->tanggal)->translatedFormat('d-m-Y') }}</td>
                                    <td>{{ $pre->kegiatan->name ?? 'Kegiatan Tidak Diketahui' }}</td>
                                    <td>{{ $presensiSiswa->siswa->user->name ?? '-' }}</td>
                                    <td>
                                        @if ($presensiSiswa->foto_selfie)
                                            <img src="{{ Storage::url($presensiSiswa->foto_selfie) }}" alt="Foto Selfie" width="100">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>{{ $presensiSiswa->time ?? \Carbon\Carbon::parse($presensiSiswa->created_at)->format('H:i:s') ?? '-' }}</td>
                                </tr>
                            @endforeach
                         @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data presensi siswa hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection