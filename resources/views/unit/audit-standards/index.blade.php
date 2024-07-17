@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Standar Audit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Standar Audit</h4>
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
                                    <th width="1px">No.</th>
                                    <th>Perbaikan</th>
                                    <th>Standar</th>
                                    <th>Butir Standar</th>
                                    <th>Temuan KTS</th>
                                    <th>Uraian Ketidaksesuaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($standards as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-pill @if ($value->repairment_status == \App\Constants\RepairmentStatus::DONE) btn-primary btn-air-primary @else btn-danger btn-air-danger @endif" role="button">
                                                {{ \App\Constants\RepairmentStatus::label($value->repairment_status) }}
                                            </a>
                                        </td>
                                        <td>{{ $value->standard?->brief_content }}</td>
                                        <td>{!! nl2br($value->standard?->content) !!}</td>
                                        <td>{{ $value->incompatibility?->name }}</td>
                                        <td>{{ $value->incompatibility_note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $standards->links() }}
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        <a href="{{ route('unit.audits.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
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
