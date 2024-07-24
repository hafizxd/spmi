<!DOCTYPE html>
<!-- saved from url=(0097)https://siami.andie-uniska.web.id/admin/ami-print.php?id_ami=20&&id_kpl=13&&id_agt1=12&&id_agt2=0 -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./Laporan AMI Prodi Komunikasi dan Penyiaran Islam_files/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laporan AMI Politeknik Negeri Semarang</title>
    <style>
        @media print {
            .hide {
                display: none;
            }
        }

        .table-bordered,
        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
          padding: 3px 6px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="background:url(../images/cover-lap.jpg) no-repeat; background-size:100%">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Program Studi / Sub Unit</td>
                                    <td>: {{ $audit->prodi?->name_prodi }}</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Ketua Program Studi / Sub Unit</td>
                                    <td>: {{ $audit->prodi?->user?->name }}</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Ketua Tim Auditor</td>
                                    <td>: {{ $audit->auditor1?->user?->name }}</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Anggota Auditor</td>
                                    <td>: {{ $audit->auditor2?->user?->name }}</td>
                                    <td>: {{ $audit->auditor3?->user?->name }}</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>:
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Siklus / Tahun</td>
                                    <td>: {{ $audit->cycle?->order_no }} / {{ $audit->cycle?->year }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
            <h1 class="text-center">{{ $audit->cycle?->year }}</h1>
            <br><br><br><br>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">LAPORAN AUDIT MUTU INTERNAL<br>PROGRAM STUDI {{ strtoupper($audit->prodi?->name_prodi) }}<br>SIKLUS KE-{{ $audit->cycle?->order_no }} TAHUN {{ $audit->cycle?->year }}</h2>
                <br><br>
                <h5>A. PENDAHULUAN</h5><br>
                <b>1. Identitas Auditee</b><br><br>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="25%">Jurusan</td>
                            <td>: {{ $audit->jurusan?->name_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Program Studi / Sub Unit</td>
                            <td>: {{ $audit->prodi?->name_prodi }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kepala Program Studi / Sub Unit</td>
                            <td>: {{ $audit->prodi?->user?->name }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Telpon</td>
                            <td>: {{ $audit->prodi?->user?->phone }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <b>2. Identitas Auditor</b><br><br>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="25%">Ketua Auditor</td>
                            <td>: {{ $audit->auditor1?->user?->name }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jurusan</td>
                            <td>: {{ $audit->auditor1?->jurusan?->name_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Telpon</td>
                            <td>: {{ $audit->auditor1?->user?->phone }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Anggota 1</td>
                            <td>: {{ $audit->auditor2?->user?->name }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jurusan</td>
                            <td>: {{ $audit->auditor2?->jurusan?->name_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Telpon</td>
                            <td>: {{ $audit->auditor2?->user?->phone }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Anggota 2</td>
                            <td>: {{ $audit->auditor3?->user?->name }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Jurusan</td>
                            <td>: {{ $audit->auditor3?->jurusan?->name_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Telpon</td>
                            <td>: {{ $audit->auditor3?->user?->phone }}</td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <h5>B. TUJUAN AUDIT</h5>
                <ol>
                    <li>Untuk memeriksa kesesuaian atau ketidaksesuaian pelaksanaan standar yang telah ditetapkan.</li>
                    <li>Untuk menyiapkan laporan kepada Teraudit (Auditee) sebagai dasar perbaikan mutu selanjutnya.</li>
                    <li>Untuk memberikan kesempatan Teraudit memperbaiki Sistem Penjaminan Mutu.</li>
                    <li>Untuk membantu Instansi/Program Studi / Sub Unit mempersiapkan diri dalam rangka Audit Ekternal atau Akreditasi.</li>
                </ol>
                <br><br>
                <h5>C. MANFAAT</h5>
                <p>Rekomendasi/manfaat langsung Audit Mutu Internal (AMI) secara langsung adalah diperoleh rekomendasi peningkatan Mutu Pendidikan Tinggi.</p>
                <br>
                <h5>D. LINGKUP AUDIT</h5><br>
                <p>1. Standar Penelitian</p>
                <ol type="a">
                    <li>Standar Hasil Penelitian</li>
                    <li>Standar Isi Penelitian</li>
                    <li>Standar Proses Penelitian</li>
                    <li>Standar Penilaian Penelitian</li>
                    <li>Standar Peneliti</li>
                    <li>Standar Sarana dan Prasarana Penelitian</li>
                    <li>Standar Pengelolaan Penelitian</li>
                    <li>Standar Pendanaan dan Pembiayaan Penelitian</li>
                </ol>
                <p>2. Standar Pengabdian Kepada Masyarakat</p>
                <ol type="a">
                    <li>Standar Hasil PkM</li>
                    <li>Standar Isi PkM</li>
                    <li>Standar Proses PkM</li>
                    <li>Standar Penilaian PkM</li>
                    <li>Standar Pengabdi</li>
                    <li>Standar Sarana dan Prasarana PkM</li>
                    <li>Standar Pengelolaan PkM</li>
                    <li>Standar Pendanaan dan Pembiayaan PkM</li>
                </ol>
                <p>3. Luaran dan Publikasi</p>
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <h5>E. MEKANISME</h5>
                <table class="table-sm table-bordered table">
                    <tr>
                        <th width="4%" class="text-center">No</th>
                        <th>Mekanisme Yang Dilakukan</th>
                        <th>Ket</th>
                    </tr>
                    @foreach ($audit->mechanisms as $value)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->is_yes ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                    @endforeach
                </table>
                <br>
                <h5>F. TEMUAN AUDIT</h5>
                <p>1. Tindak Sesuaian</p>
                <table class="table-sm table-bordered table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Standar</th>
                            <th>Butir Standar</th>
                            <th>KTS</th>
                            <th>Uraian Ketidak Sesuaian</th>
                            <th>Tindak Perbaikan</th>
                            {{-- <th>Target Waktu Penyelesaian</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audit->auditStandards as $value)
                            <tr>
                                <td class="text-center"><small>{{ $loop->iteration }}</small></td>
                                <td><small>{{ $value->standard?->brief_content }}</small></td>
                                <td><small>{!! nl2br($value->standard?->content) !!}</small></td>
                                <td class="text-center"><small>{{ $value->incompatibility?->name }}</small></td>
                                <td><small>
                                        {{ $value->incompatibility_name }}
                                    </small></td>

                                <td><small>{{ \App\Constants\RepairmentStatus::label($value->repairment_status) }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <table class="table-sm table-bordered table">
                    <tbody>
                        <tr>
                            <td>Tanggal RTM :</td>
                            <td>Auditor : <b>{{ $audit->auditor1?->user?->name }}</b></td>
                            <td>Auditee : <b>{{ $audit->prodi?->user?->name }}</b></td>
                        </tr>
                        <tr class="text-center">
                            <td><b>{{ $audit->rtm }}</b></td>
                            @if ($audit->is_locked)
                                <td colspan="2" style="color:orangered">
                                    <b>Sudah di Verifikasi</b>
                                </td>
                            @else
                                <td colspan="2" style="color:orangered">
                                    <b>Belum di Verifikasi</b>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <br>
                {{-- <p>2. Tindak Lanjut Perbaikan</p>
                <table class="table-sm table-bordered table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Standar</th>
                            <th>Butir Standar</th>
                            <th>KTS</th>
                            <th>Uraian Ketidak Sesuaian</th>
                            <th>Tindak Perbaikan</th>
                            <th>Target Waktu Penyelesaian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><small>1</small></td>
                            <td><small>C.2.4. Indikator Kinerja Utama C.2.4.a) Sistem Tata Pamong</small></td>
                            <td><small>
                                    <p>4<span style="white-space:pre"> </span>Prodi memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten dan menjamin tata pamong yang baik serta berjalan efektif dan efisien<span style="white-space:pre"> </span></p>
                                    <p>3<span style="white-space:pre"> </span>Prodi memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten dan menjamin tata pamong yang baik.<span style="white-space:pre"> </span></p>
                                    <p>2<span style="white-space:pre"> </span>Prodi memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten<span style="white-space:pre"> </span></p>
                                    <p>1<span style="white-space:pre"> </span>Prodi memiliki dokumen formal struktur organisasi dan tata kerja namun tugas dan fungsi belum berjalan secara konsisten.<span style="white-space:pre"> </span></p>
                                    <p>0<span style="white-space:pre"> </span>Prodi tidak memiliki dokumen formal struktur organisasi<span style="white-space:pre"> </span></p>
                                    <div><br></div>
                                </small></td>
                            <td class="text-center"><small>Observasi</small></td>
                            <td><small>
                                    <p>ok</p>
                                </small></td>
                            <td><small>
                                    <p>ok</p>
                                </small></td>
                            <td><small></small></td>
                            <td class="text-center"><b>Belum Dilaksanakan</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><small>2</small></td>
                            <td><small>C.2.4. Indikator Kinerja Utama C.2.4.a) Sistem Tata Pamong</small></td>
                            <td><small>
                                    <p>4<span style="white-space:pre"> </span>Prodi memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 5 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.<span style="white-space:pre"> </span></p>
                                    <p>3<span style="white-space:pre"> </span>Prodi memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 4 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.<span style="white-space:pre"> </span></p>
                                    <p>2<span style="white-space:pre"> </span>Prodi memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 3 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.<span style="white-space:pre"> </span></p>
                                    <p>1<span style="white-space:pre"> </span>prodi memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 1 s.d. 2 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.<span style="white-space:pre"> </span></p>
                                    <p>0<span style="white-space:pre"> </span>Tidak ada Skor kurang dari 1.<span style="white-space:pre"> </span></p>
                                    <div><br></div>
                                </small></td>
                            <td class="text-center"><small>Minor</small></td>
                            <td><small>
                                    <p>perbaiki</p>
                                </small></td>
                            <td><small>
                                    <p>perbaiki</p>
                                </small></td>
                            <td><small>2 Agustus 2024</small></td>
                            <td class="text-center"><b>Belum Dilaksanakan</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><small>3</small></td>
                            <td><small>C.2.4.b) Kepemimpinan dan Kemampuan Manajerial</small></td>
                            <td><small>
                                    <p>4<span style="white-space:pre"> </span>Terdapat bukti/pengakuan yang sahih bahwa pimpinan Prodi memiliki karakter kepemimpinan operasional, organisasi, dan publik<span style="white-space:pre"> </span></p>
                                    <p>3<span style="white-space:pre"> </span>Terdapat bukti/pengakuan yang sahih bahwa pimpinan Prodi memiliki 2 karakter diantara kepemimpinan operasional, organisasi, dan publik.<span style="white-space:pre"> </span></p>
                                    <p>2<span style="white-space:pre"> </span>Terdapat bukti/pengakuan yang sahih bahwa pimpinan Prodi memiliki salah satu karakter diantara kepemimpinan operasional, organisasi, dan publik.<span style="white-space:pre"> </span></p>
                                    <p>1<span style="white-space:pre"> </span>tidak ada skor kurang dari 2<span style="white-space:pre"> </span></p>
                                    <p>0<span style="white-space:pre"> </span>tidak ada skor kurang dari 2<span style="white-space:pre"> </span></p>
                                    <div><br></div>
                                </small></td>
                            <td class="text-center"><small>Minor</small></td>
                            <td><small>
                                    <p>ok</p>
                                </small></td>
                            <td><small>
                                    <p>ok</p>
                                </small></td>
                            <td><small>2 Agustus 2024</small></td>
                            <td class="text-center"><b>Belum Dilaksanakan</b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><small>4</small></td>
                            <td><small>C.2.4.b) Kepemimpinan dan Kemampuan Manajerial</small></td>
                            <td><small>
                                    <p>4<span style="white-space:pre"> </span>Pimpinan Prodi mampu : 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien, 2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga, 3) melakukan inovasi untuk menghasilkan nilai tambah.<span style="white-space:pre"> </span></p>
                                    <p>3<span style="white-space:pre"> </span>Pimpinan Prodi mampu : 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien, 2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga.<span style="white-space:pre"> </span></p>
                                    <p>2<span style="white-space:pre"> </span>Pimpinan Prodi mampu melaksanakan 6 fungsi manajemen secara efektif.<span style="white-space:pre"> </span></p>
                                    <p>1<span style="white-space:pre"> </span>Pimpinan Prodi mampu melaksanakan kurang dari 6 fungsi manajemen<span style="white-space:pre"> </span></p>
                                    <p>0<span style="white-space:pre"> </span>Tidak ada Skor kurang dari 1.<span style="white-space:pre"> </span></p>
                                    <div><br></div>
                                </small></td>
                            <td class="text-center"><small>Observasi</small></td>
                            <td><small>
                                    <p>ok</p>
                                </small></td>
                            <td><small>
                                    <p>ok</p>
                                </small></td>
                            <td><small></small></td>
                            <td class="text-center"><b>Belum Dilaksanakan</b></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table-sm table-bordered table">
                    <tbody>
                        <tr>
                            <td>Tanggal Selesai :</td>
                            <td>Auditor : <b>Adik</b></td>
                            <td>Auditee : <b>Siti</b></td>
                        </tr>
                        <tr class="text-center">
                            <td><b></b></td>
                            <th style="color:orangered">
                                Belum di Verifikasi
                            </th>
                            <th style="color:orangered">
                                Belum di Verifikasi
                            </th>
                        </tr>
                    </tbody>
                </table> --}}
                <br><br>
                <h5>G. KESIMPULAN AUDIT</h5>
                <p>Tim Auditor menyimpulkan :</p>
                <ol type="a">
                    <li>Sistem dokumen cukup lengkap untuk mendukung pelaksanaan Sistem Penjaminan Mutu Internal dan Pengelolaan Mutu Program Studi / Sub Unit (Jawaban :
                        <b>
                            {{ $audit->conclusion?->is_document_complete ? 'Ya' : 'Tidak' }} </b>)
                    </li>
                    {{-- <li>Rekap temuan sebagai berikut :</li> --}}
                </ol>
                {{-- <table class="table-sm table-bordered table text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Standar</th>
                            <th>Mayor</th>
                            <th>Minor</th>
                            <th>Observasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>C.2.4. Indikator Kinerja Utama C.2.4.a) Sistem Tata Pamong</td>
                            <td>0</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>C.2.4.b) Kepemimpinan dan Kemampuan Manajerial</td>
                            <td>0</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>0</th>
                            <th>2</th>
                            <th>2</th>
                        </tr>
                    </tfoot>
                </table> --}}
            </div>
        </div>
        {{-- <button onclick="window.print()" class="hide btn btn-primary">Print</button> --}}
        <div class="hide"><br><br><br></div>
    </div>



    {{-- <script src="./Laporan AMI Prodi Komunikasi dan Penyiaran Islam_files/bootstrap.bundle.min.js.download" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}


</body>

</html>
