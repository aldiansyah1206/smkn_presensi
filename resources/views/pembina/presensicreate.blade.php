@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Presensi Baru</h3>
        </div>
        <div class="card-body">
 
            <form action="{{ route('presensi.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="kegiatan_id" class="form-label">Pilih Kegiatan</label>
                    <select name="kegiatan_id" id="kegiatan_id" class="form-control @error('kegiatan_id') is-invalid @enderror" required>
                        <option value="">Pilih Kegiatan</option>
                        @foreach($kegiatan as $keg)
                            <option value="{{ $keg->id }}" {{ old('kegiatan_id') == $keg->id ? 'selected' : '' }}>
                                {{ $keg->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('kegiatan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required min="{{ date('Y-m-d') }}">
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                

                <div class="d-flex justify-content-between">
                    <a href="{{ route('presensi.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Buat Presensi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('tanggal').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Set waktu ke 00:00:00 untuk perbandingan

            if (selectedDate < today) {
                alert('Tanggal tidak boleh sebelum hari ini.');
                this.value = ''; // Reset value
            }
        });
    </script>
@endsection