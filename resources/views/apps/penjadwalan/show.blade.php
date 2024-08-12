@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Tabel dan Kalender Jadwal Kegiatan -->
        <div class="col-md-12">
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
        var events = {!! $penjadwalan !!};
        console.log(events); // Tambahkan ini untuk memastikan data diterima

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: events,
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
            eventOverlap: true,
        });

        calendar.render();
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