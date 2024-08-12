@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Presensi Baru</h2>
    <form action="{{ route('apps.presensi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kegiatan_id">Kegiatan</label>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control">
                @foreach($kegiatan as $k)
                <option value="{{ $k->id }}">{{ $k->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
