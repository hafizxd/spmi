@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Mekanisme</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Mekanisme</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="display" id="mytable">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th>Mekanisme</th>
                                        <th width="20%">Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($mechanisms as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>
                                                    @if($value->is_yes)
                                                        <span class="text-primary">Ya</span>
                                                    @else 
                                                        <span class="text-danger">Tidak</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection