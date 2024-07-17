@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Tanggal RTM</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Tanggal RTM</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('auditor.audits.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('auditor.audits.rtm.update', $audit->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="rtm">Tanggal RTM {{ isset($audit->rtm) ? '('.$audit->rtm.')' : '' }}</label>
                            <input class="datepicker-here form-control digits @error('rtm') is-invalid @enderror" type="text" id="rtm" name="rtm" data-language="en">
                            @error('rtm')
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

@push('script')
    <script>
        $('#rtm').datepicker({
            dateFormat: "yyyy-mm-dd"
        }).val();
    </script>
@endpush