@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-dark">Dashboard Pembina</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xl font-weight-bold text-success text-capitalize mb-2">
                                            Siswa dalam Kegiatan Anda
                                        </div>
                                        <div class="h5 mb-2 font-weight-bold text-gray-800">{{ $countSiswaKegiatan }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tambahkan card lain sesuai kebutuhan -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection