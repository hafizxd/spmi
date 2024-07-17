@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">Audit</a></li>
        <li class="breadcrumb-item active">Mekanisme</li>
    </ol>

    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Data Mekanisme</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('auditor.audits.mechanisms.save', ['id' => $audit->id]) }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="display" id="customTable">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th>Mekanisme</th>
                                        <th width="20%">Jawaban</th>
                                        @if (!$audit->is_locked)
                                            <th style="width: 100px;">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($audit->is_locked)
                                        @foreach ($mechanisms as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>
                                                    @if($value->is_yes)
                                                        <span class="text-primary">Ya</span>
                                                    @else 
                                                        <span class="text-danger">Tidak</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @forelse ($mechanisms as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>
                                                    <div class="m-checkbox-inline custom-radio-ml">
                                                        <div class="form-check form-check-inline radio radio-primary">
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-check-input" id="inline-1-{{ $value->id }}" type="radio" name="answers[{{ $value->id }}]" value="1" @if ($value->is_yes) checked @endif>
                                                                <label class="form-check-label" for="inline-1-{{ $value->id }}">Ya</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check form-check-inline radio radio-danger">
                                                            <div class="d-flex align-items-center">
                                                                <input class="form-check-input" id="inline-2-{{ $value->id }}" type="radio" name="answers[{{ $value->id }}]" value="0" @if (!$value->is_yes) checked @endif>
                                                                <label class="form-check-label" for="inline-2-{{ $value->id }}">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul class="action">
                                                        <li class="delete">
                                                            <button type="button" title="Delete Admin" class="border-0" style="background-color: transparent;" onclick="submitDelete('{{ $value->id }}')"><i class="icon-trash"></i></button>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada data</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            <td></td>
                                            <td colspan="2">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameContainer" placeholder="Masukkan mekanisme baru">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm ms-2" onclick="submitForm()">Tambah</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end me-4 mt-4">
                            @if (! $audit->is_locked)
                                <button type="submit" class="btn btn-primary btn-sm ms-2">Save</button>
                            @endif
                            <a href="{{ route('auditor.audits.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                        </div>
                    </form>

                    <form id="formStore" action="{{ route('auditor.audits.mechanisms.store', ['id' => $audit->id]) }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="name" id="name">
                    </form>

                    @foreach ($mechanisms as $value)
                        <form id="formDelete{{ $value->id }}" action="{{ route('auditor.audits.mechanisms.destroy', ['id' => $value->audit->id, 'mechanismId' => $value->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
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

        function submitForm() {
            let val = $('#nameContainer').val();
            $('#name').val(val);
            document.querySelector('#formStore').submit();
        }

        function submitDelete(id) {
            document.querySelector('#formDelete' + id).submit();
        }
    </script>
@endpush
