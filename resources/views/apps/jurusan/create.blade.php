@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary text-white ">
                <h4 class="card-title">Tambah Data Jurusan</h4>
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Pembina..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route("apps.jurusan.store") }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-1">
                                        <label for="" class="form-label">Nama Jurusan</label>
                                        <input type="text"  name="name" id="name" class="form-control" required>
                                        @error('name')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="p-2">  
                                        <input type="hidden">
                                        <button class="btn btn-success" type="submit">Tambah</button>
                                        <a href="{{'/jurusan'}}" class="btn btn-danger  btn-mg">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection