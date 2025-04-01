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
                                <th scope="col">Nama Kegiatan</th>
                                <th scope="col">Pembina</th>
                                <th scope="col" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $current_page = $kegiatan->currentPage(); ?>
                            <?php $per_page = $kegiatan->perPage(); ?>
                            <?php $no = 1 + $per_page * ($current_page - 1); ?>
                            @forelse ($kegiatan as $keg)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $keg->name }}</td>
                                <td>{{ $keg->pembina->user->name ?? 'Pembina tidak tersedia' }}</td>
                                <td>
                                    <div class="action-buttons d-flex align-items-center">
                                        <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#editKegiatanModal{{ $keg->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusKegiatanModal{{ $keg->id }}">
                                            Hapus
                                        </button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahForm" action="{{ route('apps.kegiatan.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nama Kegiatan</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pembina_id">Pilih Pembina</label>
                        <select class="form-control" id="pembina_id" name="pembina_id" required>
                            <option value="" disabled selected>Pilih Pembina...</option>
                            @foreach($pembina as $p)
                                <option value="{{ $p->id }}">{{ $p->user->name }}</option>
                            @endforeach
                        </select>
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
@foreach ($kegiatan as $keg)
<div class="modal fade" id="editKegiatanModal{{ $keg->id }}" tabindex="-1" aria-labelledby="editKegiatanModalLabel{{ $keg->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editKegiatanModalLabel{{ $keg->id }}">Edit Nama Kegiatan</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('apps.kegiatan.update', $keg->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="p-1">
                        <label for="name" class="form-label">Nama Kegiatan</label>
                        <input value="{{ $keg->name }}" type="text" name="name" id="name" class="form-control" required />
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pembina_id">Pilih Pembina</label>
                        <select class="form-control" id="pembina_id" name="pembina_id" required>
                            @foreach($pembina as $p)
                                <option value="{{ $p->id }}" {{ $keg->pembina_id == $p->id ? 'selected' : '' }}>{{ $p->user->name }}</option>
                            @endforeach
                        </select>
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

<div class="modal fade" id="hapusKegiatanModal{{ $keg->id }}" tabindex="-1" aria-labelledby="hapusKegiatanModalLabel{{ $keg->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="hapusKegiatanModalLabel{{ $keg->id }}">Hapus Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus kegiatan "{{ $keg->name }}"?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('apps.kegiatan.destroy', $keg->id) }}" method="POST">
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