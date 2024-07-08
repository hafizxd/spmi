@extends('layouts.app')
@section('content')
<ol class="breadcrumb p-l-0">
    <li class="breadcrumb-item"><a href="#">User</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.index') }}">Unit Jurusan</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.show', $user->prodi->jurusan->user->id) }}">Unit Prodi</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Edit Unit Jurusan</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.unit-jurusan.show', $user->prodi->jurusan->user->id) }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('admin.users.unit-prodi.update', ['jurusan' => $user->prodi->jurusan->user->id, 'unit_prodi' => $user->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="name_jurusan">Jurusan</label>
                            <div style="font-weight: 700;">{{ $user->prodi->jurusan->name_jurusan }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="name_prodi">Nama Prodi</label>
                            <input type="text" class="form-control @error('name_prodi') is-invalid @enderror" id="name_prodi" name="name_prodi" value="{{ old('name_prodi', $user->prodi->name_prodi) }}" placeholder="Nama Prodi">
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
                                    <input class="form-check-input" id="diploma" type="radio" name="jenjang" value="Diploma" @if($user->prodi->jenjang == 'Diploma') checked @endif>
                                    <label class="form-check-label mb-0" for="diploma">Diploma</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="sarjana" type="radio" name="jenjang" value="Sarjana" @if($user->prodi->jenjang == 'Sarjana') checked @endif>
                                    <label class="form-check-label mb-0" for="sarjana">Sarjana</label>
                                </div>
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="magister" type="radio" name="jenjang" value="Magister" @if($user->prodi->jenjang == 'Magister') checked @endif>
                                    <label class="form-check-label mb-0" for="magister">Magister</label>
                                </div>
                            </div>
                            @error('jenjang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="name">Kepala Program Studi</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama Kaprodi Lengkap Gelar">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn', $user->nidn) }}" placeholder="Nomor Induk Dosen Nasional">
                            @error('nidn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Nomor Telepon">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email Aktif">
                            @error('email')
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
