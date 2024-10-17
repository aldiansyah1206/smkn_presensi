@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tambah Presensi</h1>
    <form action="{{ route('presensi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
            <label for="waktu" class="form-label">Waktu</label>
            <input type="time" class="form-control" id="waktu" name="waktu" required>
    <form action="{{ route('apps.presensi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kegiatan_id">Kegiatan</label>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                @foreach($kegiatan as $keg)
                    <option value="{{ $keg->id }}">{{ $keg->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="siswa_id">Siswa</label>
            <select name="siswa_id" id="siswa_id" class="form-control" required>
                <!-- Isi dengan siswa yang terdaftar dalam kegiatan terpilih -->
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jam_masuk">Jam Masuk</label>
            <input type="text" name="jam_masuk" id="jam_masuk" class="form-control" placeholder="HH:MM">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

