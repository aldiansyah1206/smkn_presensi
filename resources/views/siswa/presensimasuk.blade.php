@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #4e73df; color: white; border-radius: 15px 15px 0 0;">
                    <span class="h5">Masuk</span>
                    <span id="clock" class="h6"></span>
                </div>

                <div class="card-body">
                    {{-- Webcam --}}
                    <div class="m-auto" id="my_camera" style="max-width: 100%; height: auto;"></div>

                    {{-- Hasil Foto --}}
                    <center>
                        <div id="result" class="my-3"></div>
                    </center>

                    <div class="d-grid my-3">
                        <button class="btn btn-success w-100" onClick="take_snapshot()">Ambil Foto</button>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('siswa.presensistore') }}" method="post">
                        @csrf
                        <input type="hidden" class="image-tag" name="image">
                        <div class="d-grid">
                            <button class="btn btn-primary w-100">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

<script>
    Webcam.set({
        width: 280,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_url){
            $(".image-tag").val(data_url);
            document.getElementById('result').innerHTML = '<img class="img-fluid rounded" src="'+data_url+'" alt="Gambar" style="border: 2px solid #007bff;">';
        });
    }
</script>

<script>
    var myVar = setInterval(function() {
        myTimer();
    }, 1000);
    function myTimer() {
    var d = new Date();
    var options = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true }; 
    document.getElementById("clock").innerHTML = d.toLocaleTimeString([], options);
}

</script>
@endpush

<style>

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }


    #my_camera {
        width: 100%;  
        max-height: 240px; 
        margin-bottom: 1rem; 
    }

    #result img {
        max-width: 100%; 
        height: auto; 
    }
</style>
