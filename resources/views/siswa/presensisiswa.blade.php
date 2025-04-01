@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="text-bold">Presensi</h4>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button class="btn btn-success my-2 mt-2" data-toggle="modal" data-target="#tambahModal">+Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Foto Kehadiran</th>
                                <th scope="col">Waktu Kehadiran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
