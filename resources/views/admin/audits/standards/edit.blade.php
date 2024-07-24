@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.audits.standards.index') }}">Standar</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Edit Standar</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.audits.standards.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('admin.audits.standards.update', $standard->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="cycle_id">Siklus</label>
                            <select name="cycle_id" id="cycle_id" class="form-control js-example-basic-single @error('cycle_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Siklus</option>
                                @foreach ($cycles as $value)
                                    <option value="{{ $value->id }}" @if($standard->cycle_id == $value->id) selected @endif>{{ $value->order_no }} - {{ $value->year }}</option>
                                @endforeach
                            </select>
                            @error('cycle_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="prodi_id">Prodi / Sub Unit</label>
                            <select name="prodi_id" id="prodi_id" class="form-control js-example-basic-single @error('prodi_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Prodi / Sub Unit</option>
                                @foreach ($prodi as $value)
                                    <option value="{{ $value->id }}" @if($standard->prodi_id == $value->id) selected @endif>{{ $value->name_prodi }}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="name">Standar</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $standard->name) }}" placeholder="Nama Standar">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="brief_content">Untuk Pilihan</label>
                            <input type="text" class="form-control @error('brief_content') is-invalid @enderror" id="brief_content" name="brief_content" value="{{ old('brief_content', $standard->brief_content) }}" placeholder="Text singkat mewakili Isi standar">
                            @error('brief_content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="content">Isi Standar</label>
                            <div class="editor-container editor-container_inline-editor" id="editor-container">
                                <div class="editor-container__editor">
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="10" cols="30" id="editor">{{ $standard->content }}</textarea>
                                </div>
                            </div>
                            @error('content')
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