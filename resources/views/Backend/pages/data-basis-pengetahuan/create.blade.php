@extends('Backend.layouts.main')

@section('content-wrapper')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-custom-2-800">
                <i class="fas fa-laptop-medical mr-1"></i>
                {{ $titlePage }}
            </h1>
        </div>

        <!-- Content Row -->
        <div class="card kartu-custom mb-5">
            <div class="card-header">
                <p class="m-0 p-0 text-white"><b>Tambah Data Basis Pengetahuan</b></p>
            </div>
            <div class="card-body">
                <form action="{{ URL::to('data-basis-pengetahuan') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="kode_penyakit" class="col-sm-2 col-form-label text-custom">Kode Penyakit</label>
                        <div class="col-sm-5">
                            <select class="form-select" id="kode_penyakit" name="kode_penyakit">
                                <option selected disabled>Pilih Kode Penyakit...</option>
                                @foreach ($dataPenyakit as $penyakit)
                                    @if (old('kode_penyakit') == $penyakit->kode_penyakit)
                                        <option value="{{ $penyakit->kode_penyakit }}" selected>
                                            {{ $penyakit->kode_penyakit . ' - ' . $penyakit->nama_penyakit }}</option>
                                    @else
                                        <option value="{{ $penyakit->kode_penyakit }}">
                                            {{ $penyakit->kode_penyakit . ' - ' . $penyakit->nama_penyakit }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kode_gejala" class="col-sm-2 col-form-label text-custom">Kode Gejala</label>
                        <div class="col-sm-5">
                            <select class="form-select" id="kode_gejala" name="kode_gejala">
                                <option selected disabled>Pilih Kode Gejala...</option>
                                @foreach ($dataGejala as $gejala)
                                    @if (old('kode_gejala') == $gejala->kode_gejala)
                                        <option value="{{ $gejala->kode_gejala }}" selected>
                                            {{ $gejala->kode_gejala . ' - ' . $gejala->gejala }}</option>
                                    @else
                                        <option value="{{ $gejala->kode_gejala }}">
                                            {{ $gejala->kode_gejala . ' - ' . $gejala->gejala }}</option>
                                    @endif
                                @endforeach
                            </select>
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
