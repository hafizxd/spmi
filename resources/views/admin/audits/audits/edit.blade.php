@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.audits.cycles.index') }}">Siklus</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Edit Siklus</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.audits.cycles.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('admin.audits.cycles.update', $cycle->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="year">Tahun</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $cycle->year) }}" placeholder="Tahun Siklus">
                            @error('year')
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