@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Form untuk Menambahkan Jadwal Baru -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title" id="tambahModalLabel">Tambah Jadwal Kegiatan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('apps.penjadwalan.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="kegiatan_id">Kegiatan</label>
                            <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Kegiatan</option>
                                @foreach($kegiatan as $keg)
                                    <option value="{{ $keg->id }}">{{ $keg->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_mulai">Tgl Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_selesai">Tgl Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel dan Kalender Jadwal Kegiatan -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

<!-- Script untuk FullCalendar dan Ajax -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!! $penjadwalan !!}
        });

        calendar.render();

        // Permintaan Ajax untuk menyimpan kegiatan
        document.getElementById('btn-simpan').addEventListener('click', function() {
            var kegiatanId = document.getElementById('kegiatan_id').value;
            var tanggalMulai = document.getElementById('tanggal_mulai').value;
            var tanggalSelesai = document.getElementById('tanggal_selesai').value;

            // Mengirim permintaan Ajax untuk menyimpan kegiatan
            $.ajax({
                url: "{{ route('apps.penjadwalan.store') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    kegiatan_id: kegiatanId,
                    tanggal_mulai: tanggalMulai,
                    tanggal_selesai: tanggalSelesai
                },
                success: function(response) {
                    // Memuat ulang jadwal pada kalender setelah berhasil menyimpan
                    calendar.refetchEvents();
                    // Membersihkan input form
                    document.getElementById('kegiatan_id').value = '';
                    document.getElementById('tanggal_mulai').value = '';
                    document.getElementById('tanggal_selesai').value = '';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Gagal menyimpan kegiatan.');
                }
            });
        });
    });
</script>
@endsection
