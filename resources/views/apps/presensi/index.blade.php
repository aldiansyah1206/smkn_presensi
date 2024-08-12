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

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createPresensiModal">
        Tambah Presensi
    </button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Siswa</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th>Pembina</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->siswa->nama }}</td>
                    <td>{{ $p->kegiatan->nama }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->pembina->name }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewPresensiModal{{ $p->id }}">
                            Lihat
                        </button>
                    </td>
                </tr>

                <!-- Modal untuk Detail Presensi -->
                <div class="modal fade" id="viewPresensiModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPresensiModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewPresensiModalLabel">Detail Presensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $p->id }}</p>
                                <p><strong>Siswa:</strong> {{ $p->siswa->nama }}</p>
                                <p><strong>Kegiatan:</strong> {{ $p->kegiatan->nama }}</p>
                                <p><strong>Tanggal:</strong> {{ $p->tanggal }}</p>
                                <p><strong>Pembina:</strong> {{ $p->pembina->name }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Formulir Pembuatan Presensi -->
<div class="modal fade" id="createPresensiModal" tabindex="-1" role="dialog" aria-labelledby="createPresensiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPresensiModalLabel">Tambah Presensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('apps.presensi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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

@endsection
