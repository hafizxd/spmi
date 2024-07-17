@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.index') }}">Admin</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Detail Admin</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.admins.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="p-4">
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="name">Nama</label>
                            <div style="font-weight: 700;">{{ $user->name }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="jabatan">Jabatan</label>
                            <div style="font-weight: 700;">{{ $user->jabatan }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="nidn">NIDN</label>
                            <div style="font-weight: 700;">{{ $user->nidn }}</div>
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
