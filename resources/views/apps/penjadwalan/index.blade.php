@extends('layouts.app')

@section('content')
<!-- Alert for Success or Error Message -->
@if (session('success'))
    <div class="alert alert-custom-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-custom-error" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="row">
    <!-- Form untuk Menambahkan Jadwal Baru -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title" id="tambahModalLabel">Tambah Jadwal Kegiatan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('apps.penjadwalan.store') }}" method="POST" id="jadwalForm">
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
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
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

<!-- Styling untuk kalender dan custom alert -->
<style>
    #calendar {
        max-width: 100%;
        margin: 20px auto;
        font-size: 16px;
    }

    .fc-header-toolbar {
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .fc-daygrid-event {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 5px;
        border-radius: 4px;
        font-size: 0.9em;
        white-space: normal;
        line-height: 1.2;
    }

    .fc-daygrid-event:hover {
        background-color: #0056b3;
    }

    .fc-today-button {
        pointer-events: auto !important;
        opacity: 1 !important;
    }

    /* Sembunyikan kolom waktu di tampilan mingguan dan harian */
    .fc-timegrid-slot-label, .fc-timegrid-slot {
        display: none;
    }
    .fc-timegrid-allday, .fc-timegrid-axis-cushion, .fc-timegrid-axis-frame {
        display: none;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {
        #calendar {
            font-size: 14px;
        }

        .fc-daygrid-event {
            padding: 3px;
            font-size: 0.8em;
        }

        .fc-header-toolbar {
            flex-direction: column;
            align-items: center;
        }

        .fc-header-toolbar .fc-button-group {
            margin-bottom: 10px;
        }

        .fc-daygrid-day {
            min-height: 80px;
        }
    }

    @media (max-width: 576px) {
        #calendar {
            font-size: 12px;
        }

        .fc-daygrid-event {
            padding: 2px;
            font-size: 0.7em;
        }

        .fc-daygrid-day {
            min-height: 60px;
        }
    }

    /* Custom Alert Styling */
    .alert-custom-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 10px 20px;
        margin-bottom: 15px;
        text-align: left; /* Ubah menjadi rata kiri */
        font-size: 16px;
    }

    .alert-custom-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        padding: 10px 20px;
        margin-bottom: 15px;
        text-align: left; /* Ubah menjadi rata kiri */
        font-size: 16px;
    }
</style>

<!-- Script untuk FullCalendar dan Ajax -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            locale: 'id', // Atur locale ke bahasa Indonesia
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari'
            },
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: function(info, successCallback, failureCallback) {
                $.ajax({
                    url: "{{ route('apps.penjadwalan.index') }}",
                    data: {
                        start: info.startStr,
                        end: info.endStr
                    },
                    success: function(data) {
                        successCallback(data);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
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
                if (confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) {
                    var eventId = info.event.id;

                    $.ajax({
                        url: "{{ url('penjadwalan') }}/" + eventId,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                const alertDiv = document.createElement('div');
                                alertDiv.className = 'alert alert-custom-success';
                                alertDiv.role = 'alert';
                                alertDiv.textContent = response.message || 'Jadwal berhasil dihapus.';
                                document.querySelector('.row').parentNode.insertBefore(alertDiv, document.querySelector('.row'));

                                setTimeout(() => {
                                    alertDiv.remove();
                                }, 3000);

                                calendar.refetchEvents(); // Perbarui kalender setelah penghapusan
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Gagal menghapus jadwal.');
                        }
                    });
                }
            },
            eventOverlap: true,
            height: 'auto',
            contentHeight: 'auto',
            aspectRatio: 1.5,
            dayMaxEvents: true,
        });

        calendar.render();

        // Event listener untuk resize window
        window.addEventListener('resize', function() {
            calendar.updateSize();
        });

        // Event listener untuk form submission dengan pengecekan tambahan
        var jadwalForm = document.getElementById('jadwalForm');
        if (jadwalForm) {
            jadwalForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!e.submitter || e.submitter.textContent.trim() !== 'Simpan') {
                    return;
                }

                var formData = new FormData(this);
                var kegiatanId = formData.get('kegiatan_id');
                var tanggalMulai = formData.get('tanggal_mulai');
                var tanggalSelesai = formData.get('tanggal_selesai');

                if (!kegiatanId || !tanggalMulai || !tanggalSelesai) {
                    alert('Semua field harus diisi.');
                    return;
                }

                $.ajax({
                    url: this.action,
                    type: this.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Response:', response); // Debugging
                        if (response.success) {
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-custom-success';
                            alertDiv.role = 'alert';
                            alertDiv.textContent = response.message || 'Jadwal berhasil disimpan.';
                            document.querySelector('.row').parentNode.insertBefore(alertDiv, document.querySelector('.row'));

                            setTimeout(() => {
                                alertDiv.remove();
                            }, 3000);

                            calendar.refetchEvents(); // Pastikan sinkronisasi
                        } else {
                            // Tampilkan alert error jika ada duplikat
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-custom-error';
                            alertDiv.role = 'alert';
                            alertDiv.textContent = response.message || 'Terjadi kesalahan: Data duplikat.';
                            document.querySelector('.row').parentNode.insertBefore(alertDiv, document.querySelector('.row'));

                            setTimeout(() => {
                                alertDiv.remove();
                            }, 3000);
                        }
                            },
                            error: function(xhr, status, error) {
                                console.log('Error:', xhr.responseText); // Debugging
                                alert('Gagal menyimpan jadwal. Silakan coba lagi.');
                            }
                  });
            });
        }
    });
</script>
@endsection