@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('auditor.audits.audit_standards.index', $audit->id) }}">Standar Audit</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Edit Hasil Standar</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('auditor.audits.audit_standards.index', $audit->id) }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('auditor.audits.audit_standards.update', ['id' => $audit->id, 'auditStandardId' => $standard->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="status">Status Perbaikan</label>
                            <select name="status" id="status" class="form-control js-example-basic-single @error('status') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="{{ \App\Constants\RepairmentStatus::NOT }}" @if($standard->repairment_status == \App\Constants\RepairmentStatus::NOT) selected @endif>{{ \App\Constants\RepairmentStatus::label(\App\Constants\RepairmentStatus::NOT) }}</option>
                                <option value="{{ \App\Constants\RepairmentStatus::DONE }}" @if($standard->repairment_status == \App\Constants\RepairmentStatus::DONE) selected @endif>{{ \App\Constants\RepairmentStatus::label(\App\Constants\RepairmentStatus::DONE) }}</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            @php use \App\Constants\RepairmentStatus; @endphp
                            <label for="incompatibility_id">Status Temuan KTS</label>
                            <select name="incompatibility_id" id="incompatibility_id" class="form-control js-example-basic-single @error('incompatibility_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Status</option>
                                @foreach ($incompatibilities as $value)
                                    <option value="{{ $value->id }}" @if($standard->incompatibility_id == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            @error('incompatibility_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="incompatibility_note">Uraian KTS</label>
                            <textarea name="incompatibility_note" id="incompatibility_note" class="form-control @error('incompatibility_note') is-invalid @enderror" cols="30" rows="10">{!! nl2br($standard->incompatibility_note) !!}</textarea>
                            @error('incompatibility_note')
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