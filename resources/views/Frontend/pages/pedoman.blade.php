@extends('Frontend.layouts.main')

@section('content-wrapper')
    <div class="container-fluid p-0 m-0 my-5">
        <h3 class="text-center mb-5 text-custom">Halaman Pedoman</h3>
        <div class="card kartu-custom">
            <div class="card-header text-custom fw-bold">
                Cara Pemakaian Aplikasi
            </div>
            <div class="card-body">
                <ol class="text-custom">
                    <li>Masuk ke halaman diagnosa</li>
                    <li>Input detail pemilik dan jenis musang</li>
                    <li>Pilih gejala yang dialami musang anda</li>
                    <li>Lalu, pilih proses data untuk melihat hasil</li>
                    <li>Bookmark website URL data hasil diagnosa, agar dapat anda lihat dikemudian hari jika dibutuhkan.
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
