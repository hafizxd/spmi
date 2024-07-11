@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-l-0">
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.auditors.index') }}">Auditor</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 d-flex mt-2 p-0">
                        <h4>Edit Auditor</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ route('admin.users.auditors.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <form class="p-4" method="post" action="{{ route('admin.users.auditors.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-control js-example-basic-single @error('jurusan_id') is-invalid @enderror">
                                @foreach ($jurusan as $value)
                                    <option value="{{ $value->id }}" @if($user->auditor->jurusan_id == $value->id) selected @endif>{{ $value->name_jurusan }}</option>
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
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="name">Auditor</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama Kajur Lengkap Gelar">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" value="{{ old('nidn', $user->nidn) }}" placeholder="Nomor Induk Dosen Nasional">
                            @error('nidn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Nomor Telepon">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email Aktif">
                            @error('email')
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
                        let options = ''

                        if (data.payload.lenth == 0) {
                            options += "<option value='' disabled selected>Tidak ada data prodi</option>";
                        } else {
                            data.payload.forEach(val => {
                                options += "<option value='" + val.id + "'> " + val.name_prodi + "</option>";
                            })
                        }

                        $('#prodi_id').html(options)

                        $('#prodi_id').val('{{ $user->auditor->prodi_id }}').trigger('change')
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
            populateProdi()
        });
    </script>
@endpush