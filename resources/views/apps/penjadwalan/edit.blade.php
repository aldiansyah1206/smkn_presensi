@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Edit Jadwal Kegiatan</h2>
            <form action="{{ route('apps.penjadwalan.update', $penjadwalan->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="kegiatan_id">Pilih Kegiatan</label>
                    <select name="kegiatan_id" class="form-control" required>
                        @foreach($kegiatan as $keg)
                            <option value="{{ $keg->id }}" @if($keg->id == $penjadwalan->kegiatan_id) selected @endif>{{ $keg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $penjadwalan->tanggal_mulai }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ $penjadwalan->tanggal_selesai }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
