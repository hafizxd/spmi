@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('unit.standards.index') }}">Standar</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Upload File Standar</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('unit.standards.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('unit.standards.update', $standard->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="attachment">File</label><br>
                            <a target="_blank" href="{{ asset("storage/standards/".$standard->attachment) }}">{{ $standard->attachment }}</a>
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment" value="{{ old('attachment') }}">
                            @error('attachment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection