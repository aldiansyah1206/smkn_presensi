@extends('layouts.app')
 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="text-bold">Data Siswa</h4>
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center my-2">
                    <button class="btn btn-success" data-toggle="modal" data-target="#tambahModal">+Tambah</button>
                    <form action="{{ route('apps.users.indexSiswa') }}" method="GET" class="mb-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Siswa..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Kegiatan</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $s)
                            <tr>
                                <td>{{ $s->user->name }}</td>
                                <td>{{ $s->user->email }}</td>
                                <td>{{ $s->user->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $s->kelas->name }}</td>
                                <td>{{ $s->jurusan->name }}</td>
                                <td>{{ $s->kegiatan->name ?? 'N/A' }}</td>
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>{{ $s->no_hp }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#editSiswaModal{{ $s->id }}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusSiswaModal{{ $s->id }}">Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editSiswaModal{{ $s->id }}" tabindex="-1" aria-labelledby="editSiswaModalLabel{{ $s->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-primary text-white">
                                            <h5 class="modal-title" id="editSiswaModalLabel{{ $s->id }}">Edit Siswa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('apps.users.updateSiswa', $s->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $s->user->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $s->user->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password (Masukkan password sebelumnya) </label>
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirmation">Konfirmasi Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas_id">Kelas</label>
                                                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                                                        @foreach($kelas as $k)
                                                            <option value="{{ $k->id }}" {{ $s->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jurusan_id">Jurusan</label>
                                                    <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                                                        @foreach($jurusan as $j)
                                                            <option value="{{ $j->id }}" {{ $s->jurusan_id == $j->id ? 'selected' : '' }}>{{ $j->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kegiatan_id">Kegiatan</label>
                                                    <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                                                        @foreach($kegiatan as $keg)
                                                            <option value="{{ $keg->id }}" {{ $s->kegiatan_id == $keg->id ? 'selected' : '' }}>{{ $keg->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                                        <option value="l" {{ $s->jenis_kelamin == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="p" {{ $s->jenis_kelamin == 'p' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">No HP</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $s->no_hp }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ $s->alamat }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hapus Modal -->
                            <div class="modal fade" id="hapusSiswaModal{{ $s->id }}" tabindex="-1" aria-labelledby="hapusSiswaModalLabel{{ $s->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-danger text-white">
                                            <h5 class="modal-title" id="hapusSiswaModalLabel{{ $s->id }}">Hapus Siswa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data siswa ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('apps.users.destroySiswa', $s->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $siswa->links('pagination::simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahForm" action="{{ route('apps.users.storeSiswa') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="kelas_id">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="jurusan_id">Jurusan</label>
                                <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j->id }}">{{ $j->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="kegiatan_id">Kegiatan</label>
                                <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Kegiatan</option>
                                    @foreach($kegiatan as $keg)
                                        <option value="{{ $keg->id }}">{{ $keg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                    <option selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
