@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Jadwal Kegiatan</h4>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom styling untuk kalender --}}
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
</style>

{{-- Script untuk menampilkan kalender --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            locale: 'id',
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
            events: {!! $penjadwalan !!},
            editable: false,
            droppable: false,
            eventDisplay: 'block',
            height: 'auto',  
            contentHeight: 'auto',  
            aspectRatio: 1.5,  
            eventTimeFormat: {  
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            dayMaxEvents: true,  
        });

        calendar.render();

        
        window.addEventListener('resize', function() {
            calendar.updateSize();  
        });
    });
</script>
@endsection