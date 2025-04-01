@extends('layouts.app')

@section("content")
<div class="row">
    <div class="col-lg-12">
        <h4 class="text-bold">Kelas</h4>
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <button class="btn btn-success my-3 mt-2" data-toggle="modal" data-target="#tambahModal">+Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Nama Kelas</th>
                                <th scope="col" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $current_page = $kelas->currentPage(); ?>
                            <?php $per_page = $kelas->perPage(); ?>
                            <?php $no = 1 + $per_page * ($current_page - 1); ?>
                            @forelse ($kelas as $k)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $k->name }}</td>
                                <td> 
                                        <div class="action-buttons d-flex align-items-center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editKelasModal{{ $k->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapusKelasModal{{ $k->id }}">
                                                Hapus
                                            </button>
                                        </div> 
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $kelas->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahForm" action="{{ route('apps.kelas.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Kelas</label>
                        <input type="text" name="name" class="form-control" required>
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
@foreach ($kelas as $k)
<div class="modal fade" id="editKelasModal{{ $k->id }}" tabindex="-1" aria-labelledby="editKelasModalLabel{{ $k->id }}" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editKelasModalLabel{{ $k->id }}">Edit Nama Kelas</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('apps.kelas.update', $k->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="p-1">
                        <label for="name" class="form-label">Nama Kelas</label>
                        <input value="{{ $k->name }}" type="text" name="name" id="name" class="form-control" required />
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

<div class="modal fade" id="hapusKelasModal{{ $k->id }}" tabindex="-1" aria-labelledby="hapusKelasModalLabel{{ $k->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="hapusKelasModalLabel{{ $k->id }}">Hapus Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus kelas "{{ $k->name }}"?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('apps.kelas.destroy', $k->id) }}" method="POST">
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
