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

{{-- Custom styling untuk memperindah kalender --}}
<style>
    #calendar {
        max-width: 100%;
        margin: 20px auto;
    }
    .fc-header-toolbar {
        margin-bottom: 20px;
    }
    .fc-daygrid-event {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 5px;
        border-radius: 4px;
    }
    .fc-daygrid-event:hover {
        background-color: #0056b3;
    }
</style>

{{-- Script untuk menampilkan kalender --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: {!! $penjadwalan !!},
            editable: false,
            droppable: false,
            eventDisplay: 'block',
        });

        calendar.render();
    });
</script>
@endsection
