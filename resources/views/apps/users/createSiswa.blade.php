@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Siswa</h1>
    <form action="{{ route('apps.users.storeSiswa') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <input type="text" class="form-control" id="kelas_id" name="kelas_id" required>
        </div>
        <div class="form-group">
            <label for="jurusan_id">Jurusan</label>
            <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" required>
        </div>
        <div class="form-group">
            <label for="kegiatan_id">Kegiatan</label>
            <input type="text" class="form-control" id="kegiatan_id" name="kegiatan_id" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection