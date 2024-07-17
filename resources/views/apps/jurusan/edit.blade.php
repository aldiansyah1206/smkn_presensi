@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary text-white ">
                <h4 class="card-title">Edit Nama Jurusan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('apps.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="p-1">
                        <label for="" class="form-label">Nama Jurusan</label>
                        <input value="{{ $jurusan->name }}" type="text" name="name" id="name" class="form-control" required />
                        @error('name')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="p-2">  
                        <button type="submit">Perbarui</button>
                        <a href="{{ route('apps.jurusan.index') }}" class="btn btn-danger btn-sm">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
