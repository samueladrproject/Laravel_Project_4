@extends('Frontend.layouts.main')

@section('content-wrapper')
    <div class="container-fluid p-0 m-0 my-5">
        <h3 class="text-center mb-5 text-custom">Hasil Diagnosa</h3>
        <div class="card kartu-custom mb-3">
            <div class="card-header text-white fw-bold">
                Hasil Konsultasi
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <h6 class="text-custom">*) Detail Pemilik Hewan</h6>
                    <table class="table table-bordered custom-table" style="width: 100%">
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 85%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>{{ $namaPemilik }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid">
                    <h6 class="text-custom">*) Gejala yang dialami</h6>
                    <table class="table table-bordered custom-table" style="width: 100%">
                        <colgroup>
                            <col span="1" style="width: 3%;">
                            <col span="1" style="width: 12%;">
                            <col span="1" style="width: 85%;">
                        </colgroup>
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Kode Gejala.</th>
                                <th>Nama Gejala.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($diagnosa->gejala_penyakit as $gejalaYangDipilih)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td class="text-center">{{ $gejalaYangDipilih->kode_gejala }}</td>
                                    <td>{{ $gejalaYangDipilih->nama_gejala }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="container-fluid">
                    <h6 class="text-custom">*) Detail Penyakit</h6>
                    <table class="table table-bordered custom-table" style="width: 100%">
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 80%;">
                        </colgroup>
                        <tr>
                            <td>Nama Penyakit</td>
                            <td class="text-center">:</td>
                            <td class="fw-bold">
                                {{ $diagnosa->nama_penyakit }}
                            </td>
                        </tr>
                        <tr>
                            <td>Persentase dan Nilai Kepercayaan</td>
                            <td class="text-center align-middle">:</td>
                            <td class="align-middle">{!! '<b>' . $diagnosa->persentase_penyakit . '</b>' . ' / (' . $diagnosa->nilai_belief . ')' !!}</td>
                        </tr>
                    </table>
                </div>

                <div class="container-fluid">
                    <h6 class="text-custom">*) Solusi Penyakit</h6>
                    <table class="table table-bordered custom-table" style="width: 100%">
                        <tbody>
                            @foreach (json_decode($solusi->solusi) as $solusi)
                                <tr>
                                    <td>{{ $solusi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
        <a href="{{ URL::to('diagnosa') }}" class="btn btn-custom"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke
            Halaman Diagnosa</a>
    </div>
@endsection
