@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="text-bold">Kegiatan</h4>
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
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $current_page = $presensi->currentPage(); ?>
                            <?php $per_page = $presensi->perPage(); ?>
                            <?php $no = 1 + $per_page * ($current_page - 1); ?>
                            @forelse ($presensi as $p)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->pembina->user->name ?? 'Pembina tidak tersedia' }}</td>
                                <td>
                                    <div class="p-2">
                                        <div class="row">
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPresensiModal{{ $keg->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapusPresensiModal{{ $keg->id }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $kegiatan->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
