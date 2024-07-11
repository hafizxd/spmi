@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">Auditor</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Auditor</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.auditors.create') }}" class="btn btn-primary btn-sm ms-2">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('admin.users.auditors.index') }}">
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
                                    <th>Prodi / Jurusan</th>
                                    <th>Auditor</th>
                                    <th>NIDN</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="detail me-3"><a href="{{ route('admin.users.auditors.show', $value->id) }}"><i class="icon-eye"></i></a></li>

                                                <li class="edit me-2"><a href="{{ route('admin.users.auditors.edit', $value->id) }}"><i class="icon-pencil-alt"></i></a></li>

                                                <li class="delete">
                                                    <form action="{{ route('admin.users.auditors.destroy', $value->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button title="Delete Admin" class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="icon-trash"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>{{ $value->auditor->prodi->name_prodi }} / {{ $value->auditor->jurusan->name_jurusan }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->nidn }}</td>
                                        <td><img src="{{ isset($value->photo) ? asset('storage/profile-picture/' . $value->photo) : url('/html/assets/images/dashboard/profile.jpg') }}" alt="profile_picture" style="max-width: 50px; max-height: 50px;"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
