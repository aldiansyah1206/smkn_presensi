@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Masuk</span>
                    <span id="clock"></span>
                </div>

                <div class="card-body">
                    {{-- webcam --}}
                    <div class="m-auto"id="my_camera"></div>
                    {{-- Hasil Foto--}}
                    <center>
                    <div id="result" class="my-3"></div>
                    </center>
                    <div class="d-grid my-3">
                        <button class="btn btn-primary w-100"onClick="take_snapshot()">Ambil Foto</button>
                    </div>
                    {{-- form  --}}
                    <form action="{{ route('siswa.siswamasukstore') }}" method="post">
                        @csrf
                        <input type="hidden" class="image-tag" name="image">
                        <div class="d-grid">
                            <button class="btn btn-danger w-100">Masuk</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
//webcam
<script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');

    function take_snapshot() {
    Webcam.snap(function(data_url){
        //memasukkan URL inputan
        $(".image-tag").val(data_url);
        //menampilkan gambar
        document.getElementById('result').innerHTML = '<img class="img-fluid"src="'+data_url+'" alt="gambar">'
    });
}
</script>
// waktu 
<script>
    var myVar = setInterval(function() {
        myTimer();
    },1000);
    function myTimer() {
        var d = new Date();
        document.getElementById("clock").innerHTML = d.toLocaleTimeString();
    }
</script>

@endpush