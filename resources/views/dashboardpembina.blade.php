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
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xl font-weight-bold text-success text-capitalize mb-2">
                                            Data Siswa
                                        </div>
                                        <div class="h5 mb-2 font-weight-bold text-gray-800">2</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xl font-weight-bold text-info text-capitalize mb-2">
                                            Jadwal Kegiatan
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-2 mt-1 font-weight-bold text-gray-800"></div>
                                            </div>
                                        </div>
                                        <div class="text-xl">
                                            <a href="#" class="btn btn-light btn-icon-split">
                                                <span class="icon text-gray-600">
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                                <span class="text">Lihat Detail</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xl font-weight-bold text-warning text-capitalize mb-2">
                                            Data Presensi
                                        </div>
                                        <div class="h5 mb-2 font-weight-bold text-gray-800">18</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
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
@endsection