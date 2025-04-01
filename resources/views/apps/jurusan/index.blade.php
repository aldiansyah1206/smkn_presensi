@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="text-bold">Jurusan</h4>
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
                                <th scope="col">Nama Jurusan</th>
                                <th scope="col" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $current_page = $jurusan->currentPage(); ?>
                            <?php $per_page = $jurusan->perPage(); ?>
                            <?php $no = 1 + $per_page * ($current_page - 1); ?>
                            @forelse ($jurusan as $j)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $j->name }}</td>
                                <td>
                                    <div class="action-buttons d-flex align-items-center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editJurusanModal{{ $j->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapusJurusanModal{{ $j->id }}">
                                                Hapus
                                            </button>
                                    </div> 
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $jurusan->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahForm" action="{{ route('apps.jurusan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Jurusan</label>
                        <input type="text" name="name" class="form-control" required>
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('tambahForm').submit();">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit dan Hapus -->
@foreach ($jurusan as $j)
<div class="modal fade" id="editJurusanModal{{ $j->id }}" tabindex="-1" aria-labelledby="editJurusanModalLabel{{ $j->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editJurusanModalLabel{{ $j->id }}">Edit Nama Jurusan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('apps.jurusan.update', $j->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="p-1">
                        <label for="name" class="form-label">Nama Jurusan</label>
                        <input value="{{ $j->name }}" type="text" name="name" id="name" class="form-control" required />
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusJurusanModal{{ $j->id }}" tabindex="-1" aria-labelledby="hapusJurusanModalLabel{{ $j->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="hapusJurusanModalLabel{{ $j->id }}">Hapus Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus jurusan "{{ $j->name }}"?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('apps.jurusan.destroy', $j->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
