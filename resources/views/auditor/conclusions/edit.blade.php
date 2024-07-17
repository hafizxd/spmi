@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Kesimpulan</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Kesimpulan</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('auditor.audits.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('auditor.audits.conclusions.update', $audit->id) }}">
                    @csrf
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="is_document_complete">SISTEM DOKUMEN CUKUP LENGKAP UNTUK MENDUKUNG PELAKSANAAN SISTEM PENJAMINAN MUTU INTERNAL DAN PENGELOLAAN MUTU PROGRAM STUDI :</label>
                            @if ($audit->is_locked)
                                <p>{{ $audit->conclusion?->is_document_complete ? 'Ya' : 'Tidak' }}</p>
                            @else
                                <select name="is_document_complete" id="is_document_complete" class="form-control js-example-basic-single @error('is_document_complete') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="0" @if ($audit->conclusion?->is_document_complete == false) selected @endif>Tidak</option>
                                    <option value="1" @if ($audit->conclusion?->is_document_complete == true) selected @endif>Ya</option>
                                </select>
                                @error('is_document_complete')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                        <div class="col mb-4">
                            <label for="note">JIKA LAINNYA</label>
                            @if ($audit->is_locked)
                                <p>{{ $audit->conclusion?->note }}</p>
                            @else
                                <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note', $audit->conclusion?->note) }}" placeholder="Kosongkan apabila tidak ada tambahan">
                                @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                        <div class="col mb-4">
                            <label for="input_date">TANGGAL INPUT {{ isset($audit->conclusion) ? '(' . $audit->conclusion?->input_date . ')' : '' }}</label>
                            @if (!$audit->is_locked)
                                <input class="datepicker-here form-control digits @error('input_date') is-invalid @enderror" type="text" id="input_date" name="input_date" data-language="en">
                                @error('input_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                        @if (!$audit->is_locked)
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#input_date').datepicker({
            dateFormat: "yyyy-mm-dd"
        }).val();
    </script>
@endpush
