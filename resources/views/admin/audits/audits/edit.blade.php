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
                <form class="p-4" method="post" action="{{ route('admin.audits.audits.update', $audit->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">

                        <div class="col mb-4">
                            <label for="cycle_id">Siklus</label>
                            <select name="cycle_id" id="cycle_id" class="form-control js-example-basic-single @error('cycle_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Siklus</option>
                                @foreach ($cycles as $value)
                                    <option value="{{ $value->id }}" @if ($audit->cycle_id == $value->id) selected @endif>{{ $value->order_no . ' - ' . $value->year }}</option>
                                @endforeach
                            </select>
                            @error('cycle_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-control js-example-basic-single @error('jurusan_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Jurusan</option>
                                @foreach ($jurusan as $value)
                                    <option value="{{ $value->id }}" @if ($audit->jurusan_id == $value->id) selected @endif>{{ $value->name_jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="prodi_id">Prodi</label>
                            <select name="prodi_id" id="prodi_id" class="form-control select @error('prodi_id') is-invalid @enderror">
                                <option id="except-opt" value="{{ $audit->prodi_id }}" selected>{{ $audit->prodi?->name_prodi }}</option>
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="auditor_id_1">Ketua Auditor</label>
                            <select name="auditor_1_id" id="auditor_id_1" class="form-control select @error('auditor_1_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Auditor</option>
                                @foreach ($auditors as $value)
                                    <option value="{{ $value->auditor->id }}" @if ($audit->auditor_1_id == $value->auditor->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            @error('auditor_1_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="auditor_id_2">Anggota Auditor 1</label>
                            <select name="auditor_2_id" id="auditor_id_2" class="form-control select @error('auditor_2_id') is-invalid @enderror">
                                <option value="" selected>Pilih Auditor</option>
                                @foreach ($auditors as $value)
                                    <option value="{{ $value->auditor->id }}" @if ($audit->auditor_2_id == $value->auditor->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            @error('auditor_2_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="auditor_id_3">Anggota Auditor 2</label>
                            <select name="auditor_3_id" id="auditor_id_3" class="form-control select @error('auditor_3_id') is-invalid @enderror">
                                <option value="" selected>Pilih Auditor</option>
                                @foreach ($auditors as $value)
                                    <option value="{{ $value->auditor->id }}" @if ($audit->auditor_3_id == $value->auditor->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            @error('auditor_3_id')
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
        var isChanged = false;
        populateProdi()

        function populateProdi() {
            let jurusanId = $('#jurusan_id').val()
            console.log(jurusanId)
            if (jurusanId == "" || jurusanId == "null" || jurusanId == null)
                return

            $.ajax({
                type: "GET",
                url: "{{ route('resource.prodi.index') }}",
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'jurusan_id': jurusanId
                },
                success: function(data) {
                    if (data.success == true) {
                        let options = "";

                        if (data.payload.lenth == 0) {
                            options += "<option value='' disabled>Tidak ada data prodi</option>";
                        } else {
                            data.payload.forEach(val => {
                                options += "<option value='" + val.id + "'> " + val.name_prodi + "</option>";
                            })
                        }

                        if (isChanged) {
                            $('#prodi_id').html(options)
                        } else {
                            $('#prodi_id option:not(#except-opt)').remove()
                            $('#prodi_id').append(options)
                        }
                    } else {
                        alert('Terjadi kesalahan data')
                    }
                },
                error: function(error) {
                    alert('Terjadi kesalahan')
                }
            });
        }

        $('#jurusan_id').on('change', function() {
            isChanged = true
            populateProdi()
        });
    </script>
@endpush
