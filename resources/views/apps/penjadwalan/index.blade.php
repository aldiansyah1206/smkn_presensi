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
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {!! $penjadwalan !!},
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        },
        views: {
            dayGridMonth: {
                titleFormat: {
                    month: 'long',
                    year: 'numeric'
                }
            },
            timeGridWeek: {
                titleFormat: {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                }
            },
            timeGridDay: {
                titleFormat: {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }
            }
        },
        eventClick: function(info) {
            if (confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')) {
                var eventId = info.event.id;
                
               // Log the AJAX URL to console
                console.log('AJAX URL:', "{{ url('penjadwalan') }}/" + eventId);
 
                $.ajax({
                    url: "{{ url('penjadwalan') }}/" + eventId,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        console.log('Delete Success Response:', response);
                        alert('Kegiatan berhasil dihapus.');
                        calendar.refetchEvents();
                    },
                    error: function(xhr, status, error) {
                        console.log('Delete Error Status:', status);
                        console.log('Delete Error:', error);
                        console.log('Response:', xhr.responseText);
                        alert('Gagal menghapus jadwal.');
                    }
                });
            }
        },
        eventOverlap: true,
    });

    calendar.render();

    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        var kegiatanId = formData.get('kegiatan_id');
        var tanggalMulai = formData.get('tanggal_mulai');
        var tanggalSelesai = formData.get('tanggal_selesai');

        // Cek duplikasi sebelum mengirimkan formulir
        var isDuplicate = false;
        calendar.getEvents().forEach(function(event) {
            if (event.extendedProps.kegiatan_id == kegiatanId &&
                event.start.toISOString().split('T')[0] == tanggalMulai &&
                event.end.toISOString().split('T')[0] == tanggalSelesai) {
                isDuplicate = true;
            }
        });

        if (isDuplicate) {
            alert('Kegiatan dengan ID ini sudah ada pada tanggal tersebut.');
            return;
        }

                $.ajax({
                    url: this.action,
                    type: this.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        calendar.refetchEvents();
                        document.querySelector('form').reset();
                    },
                    error: function(xhr, status, error) {
                        console.log('Save Error Status:', status);
                        console.log('Save Error:', error);
                        console.log('Response:', xhr.responseText);
                        alert('Gagal menyimpan kegiatan.');
                    }
                });
            });
        });

    </script>
    <style>
        /* Sembunyikan kolom waktu di tampilan mingguan dan harian */
        .fc-timegrid-slot-label, .fc-timegrid-slot {
            display: none;
        }
        .fc-timegrid-allday, .fc-timegrid-axis-cushion, .fc-timegrid-axis-frame {
        display: none;
        }
    </style>

@endsection