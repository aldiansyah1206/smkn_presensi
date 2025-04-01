@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Default Card Example -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-dark">Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Data Pembina Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('apps.users.indexPembina') }}" class="text-decoration-none">
                            <div class="card border-left-primary shadow h-100 py-2 clickable-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-primary text-capitalize mb-2">
                                                Data Pembina
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $countPembina }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Data Siswa Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('apps.users.indexSiswa') }}" class="text-decoration-none">
                            <div class="card border-left-success shadow h-100 py-2 clickable-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-success text-capitalize mb-2">
                                                Data Siswa
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $countSiswa }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Data Kelas Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('apps.kelas.index') }}" class="text-decoration-none">
                            <div class="card border-left-info shadow h-100 py-2 clickable-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-info text-capitalize mb-2">
                                                Data Kelas
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $countKelas }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Data Jurusan Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('apps.jurusan.index') }}" class="text-decoration-none">
                            <div class="card border-left-warning shadow h-100 py-2 clickable-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-warning text-capitalize mb-2">
                                                Data Jurusan
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $countJurusan }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Data Kegiatan Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('apps.kegiatan.index') }}" class="text-decoration-none">
                            <div class="card border-left-danger shadow h-100 py-2 clickable-card">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-danger text-capitalize mb-2">
                                                Data Kegiatan
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $countKegiatan }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Jadwal Kegiatan Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2"> 
                                            <div class="text-xl font-weight-bold text-secondary text-capitalize mb-2">
                                                Jadwal Kegiatan
                                            </div>
                                            <div class="text-xl mt-2">
                                                <a href="/penjadwalan" class="btn btn-light btn-icon-split">
                                                    <span class="icon text-gray-600">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </span>
                                                    <span class="text">Lihat Detail..</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .clickable-card {
        transition: all 0.3s ease;
    }
    .clickable-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        cursor: pointer;
    }
</style>
@endsection