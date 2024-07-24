@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.unit-jurusan.index') }}">Unit</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Detail Unit</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.unit-jurusan.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
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
                            <div style="font-weight: 700;">{{ $user->jurusan->name_jurusan }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="name">Kepala Jurusan</label>
                            <div style="font-weight: 700;">{{ $user->name }}</div>
                        </div>
                        <div class="col mb-4">
                            <label for="nidn">NIP</label>
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

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Unit Prodi</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.unit-prodi.create', $user->id) }}" class="btn btn-primary btn-sm ms-2">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('admin.users.unit-jurusan.show', $user->id) }}">
                        <div class="row mb-2">
                            <div class="col-2">
                                <input type="text" placeholder="Search...." class="form-control" value="{{ request('search') }}" name="search">
                            </div>
                            <div class="col">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="mytable">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th width="5%">Actions</th>
                                    <th>Prodi</th>
                                    <th>Jenjang</th>
                                    <th>Kaprodi</th>
                                    <th>NIP</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->jurusan->prodi as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="detail me-3"><a href="{{ route('admin.users.unit-prodi.show', ['jurusan' => $user->id, 'unit_prodi' => $value->user_id]) }}"><i class="icon-eye"></i></a></li>

                                                <li class="edit me-2"><a href="{{ route('admin.users.unit-prodi.edit', ['jurusan' => $user->id, 'unit_prodi' => $value->user_id]) }}"><i class="icon-pencil-alt"></i></a></li>

                                                <li class="delete">
                                                    <form action="{{ route('admin.users.unit-prodi.destroy', ['jurusan' => $user->id, 'unit_prodi' => $value->user_id]) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button title="Delete Admin" class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="icon-trash"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>{{ $value->name_prodi }}</td>
                                        <td>{{ $value->jenjang }}</td>
                                        <td>{{ $value->user->name }}</td>
                                        <td>{{ $value->user->nidn }}</td>
                                        <td><img src="{{ isset($value->user->photo) ? asset('storage/profile-picture/' . $value->user->photo) : url('/html/assets/images/dashboard/profile.jpg') }}" alt="profile_picture" style="max-width: 50px; max-height: 50px;"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
