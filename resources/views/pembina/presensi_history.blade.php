@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Riwayat Presensi</h1> 
        @if ($presensi->isEmpty())
            <p>Tidak ada riwayat presensi.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensi as $index => $pres)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pres->tanggal }}</td>
                            <td>{{ $pres->kegiatan->name ?? 'Tidak ada kegiatan' }}</td>
                            <td>
                                <div class="action-buttons d-flex align-items-center">
                                    <a href="{{ route('presensi.show', $pres->id) }}" class="btn btn-info btn-sm ml-2">Detail</a>
                                    <!-- Tombol untuk membuka modal -->
                                    <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal{{ $pres->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal untuk konfirmasi hapus -->
                        <div class="modal fade" id="deleteModal{{ $pres->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $pres->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $pres->id }}">Konfirmasi Penghapusan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus presensi?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <form action="{{ route('presensi.destroy', $pres->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table> 
        @endif
    </div>
@endsection  