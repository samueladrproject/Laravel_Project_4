@extends('Backend.layouts.main')

@section('content-wrapper')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-custom-2-800">
                <i class="fas fa-virus mr-1"></i>
                {{ $titlePage }}
            </h1>
        </div>

        <!-- Content Row -->
        <div class="card kartu-custom mb-5">
            <div class="card-header">
                <p class="m-0 p-0 text-white"><b>Ubah Data Penyakit</b></p>
            </div>
            <div class="card-body">
                <form action="{{ URL::to('data-penyakit/' . $idPenyakit) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="kode_penyakit" class="col-sm-2 col-form-label text-custom">Kode Penyakit</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('kode_penyakit') is-invalid @enderror"
                                id="kode_penyakit" name="kode_penyakit"
                                value="{{ old('kode_penyakit', $dataPenyakit['kode_penyakit']) }}">
                            @error('kode_penyakit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_penyakit" class="col-sm-2 col-form-label text-custom">Nama Penyakit</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control @error('nama_penyakit') is-invalid @enderror"
                                id="nama_penyakit" name="nama_penyakit"
                                value="{{ old('nama_penyakit', $dataPenyakit['nama_penyakit']) }}">
                            @error('nama_penyakit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_penyakit" class="col-sm-2 col-form-label text-custom">Solusi Penyakit</label>
                        <div class="col-sm-8" id="containerSolusi">
                            @foreach (json_decode($dataPenyakit['solusi']) as $solusi)
                                <input type="text" class="form-control mb-2" id="solusi_penyakit" name="solusi_penyakit[]"
                                    value="{{ $solusi }}">
                            @endforeach
                            <button class="btn btn-custom-2 mb-2" type="button" onclick="addInput('nama_penyakit');">
                                <i class="fas fa-plus me-1"></i>
                                Tambah Solusi
                            </button>
                            @if (session()->has('errorInput'))
                                <p class="text-custom">{{ session('errorInput') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-custom-2 me-md-2" type="submit">
                                <i class="fas fa-save me-1"></i>
                                Simpan Data
                            </button>
                            <button class="btn btn-secondary" type="reset">
                                <i class="fas fa-ban me-1"></i>
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
