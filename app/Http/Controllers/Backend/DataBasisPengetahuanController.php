<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BasisPengetahuan;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class DataBasisPengetahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Basis Pengetahuan',
            'navLink' => 'data-basis-pengetahuan',
            'dataBasisPengetahuan' => BasisPengetahuan::all()
        ];

        return view('Backend.pages.data-basis-pengetahuan.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Data Basis Pengetahuan',
            'navLink' => 'data-basis-pengetahuan',
            'dataPenyakit' => Penyakit::all(),
            'dataGejala' => Gejala::all()
        ];

        return view('Backend.pages.data-basis-pengetahuan.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasisPengetahuan $basisPengetahuan, Request $request)
    {
        $validateReq = $request->validate([
            'kode_penyakit' => 'required',
            'kode_gejala' => 'required'
        ]);

        $basisPengetahuan->kode_penyakit = $validateReq['kode_penyakit'];
        $basisPengetahuan->kode_gejala = $validateReq['kode_gejala'];
        $basisPengetahuan->save();

        return redirect()->to('data-basis-pengetahuan')->with('success', 'Data Basis Pengetahuan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function show(BasisPengetahuan $basisPengetahuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function edit($data_basis_pengetahuan, BasisPengetahuan $basisPengetahuan)
    {
        $dataBasisPengetahuan = $basisPengetahuan->find($data_basis_pengetahuan)->toArray();

        $datas = [
            'titlePage' => 'Data Basis Pengetahuan',
            'navLink' => 'data-basis-pengetahuan',
            'dataPenyakit' => Penyakit::all(),
            'dataGejala' => Gejala::all(),
            'idBasisPengetahuan' => $dataBasisPengetahuan['id_basis_pengetahuan'],
            'dataBasisPengetahuan' => $dataBasisPengetahuan
        ];

        return view('Backend.pages.data-basis-pengetahuan.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function update($data_basis_pengetahuan, Request $request, BasisPengetahuan $basisPengetahuan)
    {
        $dataBasisPengetahuan = $basisPengetahuan->find($data_basis_pengetahuan);

        $validateReq = $request->validate([
            'kode_penyakit' => 'required',
            'kode_gejala' => 'required'
        ]);

        $dataBasisPengetahuan->kode_penyakit = $validateReq['kode_penyakit'];
        $dataBasisPengetahuan->kode_gejala = $validateReq['kode_gejala'];
        $dataBasisPengetahuan->save();

        return redirect()->to('data-basis-pengetahuan')->with('success', 'Data Basis Pengetahuan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BasisPengetahuan  $basisPengetahuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($data_basis_pengetahuan, BasisPengetahuan $basisPengetahuan)
    {
        $dataBasisPengetahuan = $basisPengetahuan->find($data_basis_pengetahuan);
        $dataBasisPengetahuan->delete();

        return redirect()->to('data-basis-pengetahuan')->with('success', 'Data Basis Pengetahuan berhasil dihapus');
    }
}
