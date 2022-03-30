<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

class DataGejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Gejala',
            'navLink' => 'data-gejala',
            'dataGejala' => Gejala::all()
        ];

        return view('Backend.pages.data-gejala.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Data Gejala',
            'navLink' => 'data-gejala',
        ];

        return view('Backend.pages.data-gejala.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Gejala $gejala, Request $request)
    {
        $validateReq = $request->validate([
            'kode_gejala' => 'required|unique:tabel_data_gejala',
            'gejala' => 'required',
            'nilai_densitas' => 'required'
        ]);

        $gejala->kode_gejala = $validateReq['kode_gejala'];
        $gejala->gejala = $validateReq['gejala'];
        $gejala->nilai_densitas = $validateReq['nilai_densitas'];
        $gejala->save();

        return redirect()->to('data-gejala')->with('success', 'Data Gejala berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function show(Gejala $gejala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function edit($data_gejala, Gejala $gejala)
    {
        $dataGejala = $gejala->find($data_gejala)->toArray();

        $datas = [
            'titlePage' => 'Data Gejala',
            'navLink' => 'data-gejala',
            'idGejala' => $dataGejala['id_gejala'],
            'dataGejala' => $dataGejala
        ];

        return view('Backend.pages.data-gejala.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function update($data_gejala, Request $request, Gejala $gejala)
    {
        $dataGejala = $gejala->find($data_gejala);

        $validateReq = $request->validate([
            'kode_gejala' => 'required',
            'gejala' => 'required',
            'nilai_densitas' => 'required'
        ]);

        $dataGejala->kode_gejala = $validateReq['kode_gejala'];
        $dataGejala->gejala = $validateReq['gejala'];
        $dataGejala->nilai_densitas = $validateReq['nilai_densitas'];
        $dataGejala->save();

        return redirect()->to('data-gejala')->with('success', 'Data Gejala berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function destroy($data_gejala, Gejala $gejala)
    {
        $dataGejala = $gejala->find($data_gejala);
        $dataGejala->delete();

        return redirect()->to('data-gejala')->with('success', 'Data Gejala berhasil dihapus');
    }
}
