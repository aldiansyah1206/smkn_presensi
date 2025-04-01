@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Presensi</h1>
    
    <div class="card mb-3">
        <div class="card-body">
            <p>Kegiatan: {{ $presensi->kegiatan->name ?? 'Tidak ada kegiatan' }}</p>
        </div>
    </div>

    @if (empty($presensiSiswa) || $presensiSiswa->isEmpty())
        <p>Tidak ada siswa yang mengisi presensi pada tanggal ini.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Foto Selfie</th>
                    <th>Waktu Presensi</th>
                    <th>Aksi</th>  
                </tr>
            </thead>
            <tbody>
                @foreach ($presensiSiswa as $index => $ps)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ps->siswa->user->name }}</td> 
                        <td>
                            @if ($ps->foto_selfie)
                                <img src="{{ Storage::url($ps->foto_selfie) }}" alt="Foto Selfie" width="100">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        <td>{{ $ps->time ?? \Carbon\Carbon::parse($ps->created_at)->format('H:i:s') }}</td>
                        <td>
                            <div class="action-buttons d-flex align-items-center"> 
                                <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal{{ $ps->id }} ">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Hapus -->
                    <div class="modal fade" id="deleteModal{{ $ps->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus presensi untuk {{ $ps->siswa->user->name }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('pembina.presensi.siswa.delete', $ps->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('presensi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection