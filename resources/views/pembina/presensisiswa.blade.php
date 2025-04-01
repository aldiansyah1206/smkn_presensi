@extends('layouts.app')

@section('content') 
<div class="container">
    <h1>Daftar Presensi</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Siswa yang Belum Melakukan Presensi Hari Ini ({{ $tanggalHariIni }})</h2>

    @foreach ($siswaKegiatan as $kegiatanId => $siswaList)
        <h3>Kegiatan ID: {{ $kegiatanId }}</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswaList as $siswa)
                    <tr>
                        <td>{{ $siswa->id }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPresensiModal{{ $siswa->id }}">
                                Tambah Presensi
                            </button>
                        </td>
                    </tr>

                    <!-- Modal untuk Menambah Presensi -->
                    <div class="modal fade" id="addPresensiModal{{ $siswa->id }}" tabindex="-1" role="dialog" aria-labelledby="addPresensiModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPresensiModalLabel">Tambah Presensi untuk {{ $siswa->nama }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('apps.presensi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatanId }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggalHariIni }}" required readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    @endforeach

</div>
@endsection
