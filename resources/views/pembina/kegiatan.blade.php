@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kegiatan yang Dikelola</h2>

    @if ($kegiatan)
        <h3>{{ $kegiatan->name }}</h3>
        <h4>Daftar Siswa:</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswa as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->kelas->name }}</td>
                        <td>{{ $item->jurusan->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada siswa yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <p>Tidak ada kegiatan yang dikelola.</p>
    @endif
</div>
@endsection
