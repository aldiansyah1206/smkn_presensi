@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <h3 class="mb-4">Selamat Datang, {{ Auth::user()->name }}</h3>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-body text-center">
                <img src="/img/logosmkn.jpg" alt="avatar" class="rounded-circle img-fluid mb-3" style="width: 150px;">
                <h6 class="font-weight-bold">SMK NEGERI 1 BALAI</h6>
                <p class="text-muted">
                    Jl. Bakung Kec. Balai Kab. Sanggau<br>Kode Pos 34537
                    <br><a href="mailto:snmkn1balai@gmail.com">snmkn1balai@gmail.com</a><br>Telp.081222333444
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h6 class="font-weight-bold">Presensi Disini</h6>               
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="waktu_presensi">Waktu Presensi</label>
                        <input type="datetime-local" class="form-control" name="waktu_presensi" id="waktu_presensi" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Presensi Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
