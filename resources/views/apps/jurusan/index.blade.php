@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="text-bold">Jurusan</h4>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a class="btn btn-success" href="{{ route('apps.jurusan.create') }}">+Tambah</a> 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col"class="text-center">No</th>
                                <th scope="col">Nama Jurusan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $current_page = $jurusan->currentPage(); ?>
                            <?php $per_page = $jurusan->perPage(); ?>
                            <?php $no = 1 + $per_page * ($current_page - 1); ?>
                            <?php if (count($jurusan) > 0): ?>
                                <?php foreach ($jurusan as $j): ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $j['name'] ?></td>
                                        <td>
                                            <div class="p-2">
                                                <div class="row">
                                                    <div>
                                                        <a class="btn btn-warning " value="" href="{{ route("apps.jurusan.edit", $j->id) }}">Edit</a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route("apps.jurusan.destroy", $j->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $jurusan->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
</div>
@endsection