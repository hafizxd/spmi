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
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="customTable">
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
                                                <div><a href="{{ route('admin.proses_audits.mechanisms.index', $value->id) }}" class="btn btn-sm btn-pill @if ($value->is_mechanism) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">
                                                        @if ($value->is_mechanism)
                                                            Sudah Diisi
                                                        @else
                                                            Belum Diisi
                                                        @endif
                                                    </a></div>
                                                <span>Audit</span>
                                                <div><a href="{{ route('admin.proses_audits.audit_standards.index', $value->id) }}" class="btn btn-sm @if ($value->is_audit) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">
                                                        @if ($value->is_audit)
                                                            Sudah Diisi
                                                        @else
                                                            Belum Diisi
                                                        @endif
                                                    </a></div>
                                                <span>Kesimpulan</span>
                                                <div><a href="{{ route('admin.proses_audits.conclusions.index', $value->id) }}" class="btn btn-sm @if ($value->is_conclusion) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">
                                                        @if ($value->is_conclusion)
                                                            Sudah Diisi
                                                        @else
                                                            Belum Diisi
                                                        @endif
                                                    </a></div>
                                                <span>Tanggal RTM</span>
                                                <div><a href="#" class="btn btn-sm @if (isset($value->rtm)) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">
                                                        @if (isset($value->rtm))
                                                            {{ $value->rtm }}
                                                        @else
                                                            Belum Diisi
                                                        @endif
                                                    </a></div>
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
                                            <span>Status Akhir: <a href="#" class="btn btn-xs @if ($value->is_done) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">
                                                    @if ($value->is_done)
                                                        Selesai
                                                    @else
                                                        Proses
                                                    @endif
                                                </a></span>
                                        </td>
                                        <td>
                                            @if ($value->is_done)
                                                <a href="{{ route('audits.print', $value->id) }}" class="btn btn-sm btn-pill btn-primary btn-air-primary" role="button">Print Lap Audit</a>
                                            @else
                                                -
                                            @endif
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

@push('script')
    <script>
        $(function() {
            $('#customTable').DataTable({
                "responsive": true,
                "paging": false,
                "info": false,
                "scrollCollapse": true,
                "autoWidth": false,
                'searching': false,
                'ordering': false
            });
        });
    </script>
@endpush
