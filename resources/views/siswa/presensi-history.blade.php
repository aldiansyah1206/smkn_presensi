@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h3 class="mb-4">Riwayat Presensi</h3>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Presensi Anda</h5>
                </div>
                <div class="card-body">
                    @if ($presensiHistory->isEmpty())
                        <p class="text-muted text-center">Belum ada riwayat presensi.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kegiatan</th>
                                        <th>Foto Selfie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presensiHistory as $index => $presensi)
                                        <tr>
                                            <td>{{ $presensiHistory->firstItem() + $index }}</td>
                                            <td>{{ \Carbon\Carbon::parse($presensi->tanggal)->translatedFormat('d-m-Y') }}</td>
                                            <td>
                                                {{ $presensi->name ?? 'Kegiatan Tidak Diketahui' }}
                                            </td>
                                            <td>
                                                <img src="{{ Storage::url($presensi->foto_selfie) }}" alt="Foto Selfie" class="img-fluid rounded" style="max-width: 100px; border: 2px solid #007bff;">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $presensiHistory->links('pagination::simple-bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .card-header {
        border-radius: 15px 15px 0 0;
    }
    .card {
        border-radius: 15px;
    }
</style>
@endpush