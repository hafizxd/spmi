@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
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
                                    <th width="2%">No.</th>
                                    <th width="5%">Actions</th>
                                    <th>Prodi / Jurusan</th>
                                    <th>Auditor</th>
                                    <th>NIDN</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($auditors as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul class="action"> 
                                                <li class="edit me-2"><a href="{{ route('admin.users.auditors.edit', $value->id) }}" title="Edit Admin"><i class="icon-pencil-alt"></i></a></li>

                                                {{-- <li class="me-2"><a href="{{ url('/pegawai/edit-password/'.$du->id) }}" title="Ganti Password"><i class="fa fa-solid fa-key" style="color: rgb(11, 18, 222)"></i></a></li> --}}

                                                {{-- <li class="me-2"> <a href="{{ url('/pegawai/shift/'.$du->id) }}" title="Input Shift Pegawai"><i style="color:coral" class="fa fa-solid fa-clock"></i></a></li>

                                                <li class="me-2"> <a href="{{ url('/pegawai/dinas-luar/'.$du->id) }}" title="Input Dinas Luar Pegawai"><i style="color:rgb(43, 198, 203)" class="fa fa-solid fa-route"></i></a></li>

                                                @if ($du->foto_face_recognition == null || $du->foto_face_recognition == "")
                                                    <li><a href="{{ url('/pegawai/face/'.$du->id) }}" title="Face Recognition"><i style="color: black" class="fa fa-solid fa-camera"></i></a></li>
                                                @endif --}}

                                                <li class="delete">
                                                    <form action="{{ route('admin.users.auditors.destroy', $value->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button title="Delete Admin" class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="icon-trash"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                        {{-- <td>{{ $value->name }}</td>
                                        <td>{{ $value->username }}</td>
                                        <td><img src="{{ asset("storage/logo/".$value->organization?->logo) }}" alt="logo" style="max-width: 50px; max-height: 50px;"> {{ $value->organization?->name }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $auditors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




