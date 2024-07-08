@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.index') }}">Unit Jurusan</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.show', $user->prodi->jurusan->user->id) }}">Unit Prodi</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Detail Unit Jurusan</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.unit-jurusan.show', $user->prodi->jurusan->user->id) }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="p-4">
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="name_jurusan">Jurusan</label>
                            <div style="font-weight: 700;">{{ $user->prodi->jurusan->name_jurusan }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="name_jurusan">Program Studi</label>
                            <div style="font-weight: 700;">{{ $user->prodi->name_prodi }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="name_jurusan">Jenjang</label>
                            <div style="font-weight: 700;">{{ $user->prodi->jenjang }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="name">Kepala Program Studi</label>
                            <div style="font-weight: 700;">{{ $user->name }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="nidn">NIDN</label>
                            <div style="font-weight: 700;">{{ $user->nidn }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="phone">Nomor Telepon</label>
                            <div style="font-weight: 700;">{{ $user->phone }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="email">Email</label>
                            <div style="font-weight: 700;">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
