@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Presensi Kegiatan</h2>
    <form action="{{ route('apps.presensi.now') }}" method="POST">
        @csrf
        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
        <button type="submit" class="btn btn-primary">Presensi Sekarang</button>
    </form>
</div>
@endsection
