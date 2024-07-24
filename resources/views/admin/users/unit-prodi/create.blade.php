@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.index') }}">Unit</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.show', $userJurusan->id) }}">Unit Prodi</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Tambah Unit Prodi</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.unit-jurusan.show', $userJurusan->id) }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('admin.users.unit-prodi.store', $userJurusan->id) }}">
                    @csrf
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="name_jurusan">Jurusan</label>
                            <div style="font-weight: 700;">{{ $userJurusan->jurusan->name_jurusan }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="name_prodi">Nama Prodi</label>
                            <input type="text" class="form-control @error('name_prodi') is-invalid @enderror" id="name_prodi" name="name_prodi" value="{{ old('name_prodi') }}" placeholder="Nama Prodi">
                            @error('name_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="jenjang">Jenjang</label>
                            <div class="m-checkbox-inline custom-radio-ml">
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="diploma" type="radio" name="jenjang" value="Diploma">
                                    <label class="form-check-label mb-0" for="diploma">Diploma</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="sarjana" type="radio" name="jenjang" value="Sarjana">
                                    <label class="form-check-label mb-0" for="sarjana">Sarjana</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="magister" type="radio" name="jenjang" value="Magister">
                                    <label class="form-check-label mb-0" for="magister">Magister</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="non_jenjang" type="radio" name="jenjang" value="Non Jenjang">
                                    <label class="form-check-label mb-0" for="non_jenjang">Non Jenjang</label>
                                </div>
                            </div>
                            @error('jenjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="name">Kepala Program Studi / Sub Unit</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Kaprodi Lengkap Gelar">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="nidn">NIP</label>
                            <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn') }}" placeholder="Nomor Induk Dosen Nasional">
                            @error('nidn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nomor Telepon">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email Aktif">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="password">Password</label>
                            <input type="password" au class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="password_confirm">Confirm Password</label>
                            <input type="password" au class="form-control @error('password_confirm') is-invalid @enderror" id="password_confirm" name="password_confirm" value="{{ old('password_confirm') }}" placeholder="Confirm Password">
                            @error('password_confirm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
