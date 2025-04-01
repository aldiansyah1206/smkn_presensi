@extends('layouts.app')

@section('content')
            <!-- Pesan Sukses atau Error -->
 @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
 @endif
 
 @if (session('info'))
    <div class="alert alert-warning" role="alert">
     {{ session('info') }}
    </div>
 @endif
<div class="row justify-content-center">
    <div class="col-lg-12">
        <h3 class="mb-4">Selamat Datang {{ Auth::user()->name }}</h3>
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
        <div class="container">
            <div class="row align-items-center ">
                <!-- Presensi Masuk Card -->
                <div class="col-md-6">
                    <a href="{{ route('siswa.presensi') }}" class="text-decoration-none">
                        <div class="card mb-4 shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-sign-in-alt fa-4x mb-3"></i>
                                <h5 class="text-dark">Presensi Masuk</h5>
                            </div>
                        </div>
                    </a>
                </div>
        
                <!-- Jadwal Kegiatan Card -->
                <div class="col-md-6">
                    <a href="{{ route('apps.penjadwalan.jadwalsiswa') }}" class="text-decoration-none">
                        <div class="card mb-4 shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-calendar-alt fa-4x mb-3"></i>
                                <h5 class="text-dark">Jadwal Kegiatan</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        transition: all 0.3s ease-in-out; /* Smooth transition for the hover effect */
    }
</style>
@endsection