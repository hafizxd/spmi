@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Standar</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Standar</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('unit.standards.index') }}">
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
                                    <th>Standar</th>
                                    <th>Untuk Pilihan</th>
                                    <th>Isi Standar</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($standards as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->brief_content }}</td>
                                        <td>
                                            {!! nl2br(substr($value->content, 0, 100)) !!}
                                            @if(strlen($value->content) > 100)
                                                ...
                                            @endif
                                        </td>
                                        <td><a target="_blank" href="{{ asset("storage/standards/".$value->attachment) }}">{{ $value->attachment }}</a></td>
                                        <td>
                                            <ul class="action">
                                                <li class="detail me-3"><a href="{{ route('unit.standards.show', $value->id) }}"><i class="icon-eye"></i></a></li>
                                                <li class="edit me-2"><a href="{{ route('unit.standards.edit', $value->id) }}"><i class="icon-upload"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $standards->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
