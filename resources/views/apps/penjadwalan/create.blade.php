@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $title }}</h2>
            <form action="{{ route('apps.penjadwalan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kegiatan_id">Pilih Kegiatan</label>
                    <select name="kegiatan_id" class="form-control" required>
                        @foreach($kegiatan as $keg)
                            <option value="{{ $keg->id }}">{{ $keg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
