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
                    <div class="m-auto" id="my_camera"></div>

                    <center>
                        <div id="result" class="my-3"></div>
                    </center>

                    <div class="d-grid my-3">
                        <button class="btn btn-success w-100" onClick="take_snapshot()">Ambil Foto</button>
                    </div>
                    <form action="{{ route('siswa.presensistore') }}" method="post">
                        @csrf
                        <input type="hidden" name="presensi_id" value="{{ $presensi->id ?? '' }}">
                        <input type="hidden" name="foto_selfie" id="foto_selfie_base64" required>
                        <div class="d-grid">
                            <button class="btn btn-primary w-100" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
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
        Webcam.snap(function(data_url) {
            $("#result").html('<img class="img-fluid rounded" src="' + data_url + '" alt="Gambar" style="border: 2px solid #007bff;">');
            $("#foto_selfie_base64").val(data_url);
        });
    }
</script>

<script>
    setInterval(function() {
        let d = new Date();
        let options = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
        $("#clock").html(d.toLocaleTimeString([], options));
    }, 1000);
</script>
@endpush