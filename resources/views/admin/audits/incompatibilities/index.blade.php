@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Ketidaksesuaian</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Ketidaksesuaian</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.audits.incompatibilities.create') }}" class="btn btn-primary btn-sm ms-2">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('admin.audits.incompatibilities.index') }}">
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
                                    <th>KTS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incompatibilities as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit me-2"><a href="{{ route('admin.audits.incompatibilities.edit', $value->id) }}"><i class="icon-pencil-alt"></i></a></li>

                                                <li class="delete">
                                                    <form action="{{ route('admin.audits.incompatibilities.destroy', $value->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button title="Delete Admin" class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="icon-trash"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>{{ $value->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $incompatibilities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
