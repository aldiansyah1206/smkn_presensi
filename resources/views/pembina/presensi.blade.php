@extends('layouts.app')

@section('content')  
<!-- Main Content -->
<div class="col-md-12 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="text-dark">Presensi Kegiatan</h2>
        <div class="d-flex flex-wrap">
            <a href="{{ route('pembina.presensicreate') }}" class="btn btn-success me-3 mb-2"><i class="fas fa-plus"></i> Tambah Presensi</a>
            <a href="#" class="btn btn-primary mb-2"><i class="fas fa-file-export"></i> Export Data</a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Presensi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive"> <!-- Membuat tabel responsif -->
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                            <th>Foto Selfie</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>2024-10-20</td>
                            <td>Soccer</td>
                            <td>
                                <img src="path/to/foto.jpg" alt="Foto Selfie" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Masuk</span>
                            </td>
                        </tr>
                        <!-- Tambahkan data presensi lainnya di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
