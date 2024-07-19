@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Detail Jadwal Kegiatan</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $penjadwalan->kegiatan->name }}</h5>
                    <p class="card-text"><strong>Tanggal Mulai:</strong> {{ $penjadwalan->tanggal_mulai }}</p>
                    <p class="card-text"><strong>Tanggal Selesai:</strong> {{ $penjadwalan->tanggal_selesai }}</p>
                    <a href="{{ route('apps.penjadwalan.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
