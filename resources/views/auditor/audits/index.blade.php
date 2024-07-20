@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Audit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Audit</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('auditor.files.index') }}" class="btn btn-primary btn-sm ms-2" type="button">Files</a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ route('auditor.audits.index') }}">
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
                                    <th>Proses Audit</th>
                                    <th>Informasi Audit</th>
                                    <th>Laporan Audit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audits as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <div style="display: grid; grid-template-columns: 1fr 2fr; grid-row-gap: 10px; align-items: center;">
                                                <span>Mekanisme</span>
                                                <div><a href="{{ route('auditor.audits.mechanisms.index', $value->id) }}" class="btn btn-sm btn-pill @if($value->is_mechanism) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">@if($value->is_mechanism) Sudah Diisi @else Belum Diisi @endif</a></div>
                                                <span>Audit</span>
                                                <div><a href="{{ route('auditor.audits.audit_standards.index', $value->id) }}" class="btn btn-sm @if($value->is_audit) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">@if($value->is_audit) Sudah Diisi @else Belum Diisi @endif</a></div>
                                                <span>Kesimpulan</span>
                                                <div><a href="{{ route('auditor.audits.conclusions.index', $value->id) }}" class="btn btn-sm @if($value->is_conclusion) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">@if($value->is_conclusion) Sudah Diisi @else Belum Diisi @endif</a></div>
                                                <span>Tanggal RTM</span>
                                                <div><a href="{{ $value->is_locked ? '#' : route('auditor.audits.rtm.index', $value->id) }}" class="btn btn-sm @if(isset($value->rtm)) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">@if(isset($value->rtm)) {{ $value->rtm }} @else Belum Diisi @endif</a></div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span>Prodi: <span style="text-decoration: underline;">{{ $value->prodi->name_prodi }}</span></span><br>
                                            <span>Jurusan: <span style="text-decoration: underline;">{{ $value->jurusan->name_jurusan }}</span></span><br>
                                            <span>Ketua Auditor: <span style="text-decoration: underline;">{{ $value->auditor1->user->name }}</span></span><br>
                                            <span>Anggota: 
                                                <br><span style="text-decoration: underline;">{{ $value->auditor2?->user->name }}</span>
                                                <br><span style="text-decoration: underline;">{{ $value->auditor3?->user->name }}</span>
                                            </span><br><br>
                                            <span>Status Akhir: <a href="#" class="btn btn-xs @if($value->is_done) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">@if($value->is_done) Selesai @else Proses @endif</a></span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('audits.print', $value->id) }}" class="btn btn-sm @if($value->is_done) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">Print Lap Audit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $audits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
