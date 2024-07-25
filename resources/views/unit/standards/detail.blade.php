@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item active"><a href="{{ route('unit.standards.index') }}">Standar</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Detail Standar</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('unit.standards.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="form-row p-4">
                    <div class="col mb-4">
                        <label for="cycle_id">Siklus</label>
                        <p>{{ $standard->cycle?->order_no }} - {{ $standard->cycle?->year }}</p>
                    </div>
                    <div class="col mb-4">
                        <label for="prodi_id">Prodi / Sub Unit</label>
                        <p>{{ $standard->prodi?->name_prodi }}</p>
                    </div>
                    <div class="col mb-4">
                        <label for="name">Standar</label>
                        <p>{{ $standard->name }}</p>
                    </div>
                    <div class="col mb-4">
                        <label for="brief_content">Untuk Pilihan</label>
                        <p>{{ $standard->brief_content }}</p>
                    </div>
                    <div class="col mb-4">
                        <label for="content">Isi Standar</label>
                        <p>{!! nl2br($standard->content) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection