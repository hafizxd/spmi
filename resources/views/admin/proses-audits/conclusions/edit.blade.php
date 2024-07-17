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
                        <a href="{{ route('admin.proses_audits.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="#">
                    @csrf
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="is_document_complete">SISTEM DOKUMEN CUKUP LENGKAP UNTUK MENDUKUNG PELAKSANAAN SISTEM PENJAMINAN MUTU INTERNAL DAN PENGELOLAAN MUTU PROGRAM STUDI :</label>
                            <p>{{ $audit->conclusion?->is_document_complete ? 'Ya' : 'Tidak' }}</p>
                        </div>
                        <div class="col mb-4">
                            <label for="note">JIKA LAINNYA</label>
                            <p>{{ $audit->conclusion?->note }}</p>
                        </div>
                        <div class="col mb-4">
                            <label for="input_date">TANGGAL INPUT</label>
                            <p>{{ $audit->conclusion?->input_date }}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection