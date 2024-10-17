@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
            @if ($kegiatan->isNotEmpty())
                <h4 class="text-bold">Daftar Siswa</h4>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <a href="{{ route('pembina.siswaPdf') }}" class="btn btn-primary mb-1">Export PDF</a>
                    </div>
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kegiatan</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @forelse ($siswa as $index => $s)
                                            <tr>
                                                <td>{{ $s->user->name }}</td>
                                                <td>{{ $s->kelas->name }}</td>
                                                <td>{{ $s->jurusan->name }}</td>
                                                <td>{{ $s->jenis_kelamin }}</td> 
                                                <td>{{ $s->kegiatan->name}}</td> 
                                                <td>{{ $s->no_hp }}</td>
                                                <td>{{ $s->alamat }}</td> 
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">Tidak ada siswa yang terdaftar.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                            </table>
                            @else
                                <td colspan="10" class="text-center">Tidak ada data yang dikelola.</td>
                            @endif
                    </div>
                </div>
    </div>
</div>
@endsection
