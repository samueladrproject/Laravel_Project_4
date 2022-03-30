<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class DataPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Penyakit',
            'navLink' => 'data-penyakit',
            'dataPenyakit' => Penyakit::all()
        ];

        return view('Backend.pages.data-penyakit.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = [
            'titlePage' => 'Data Penyakit',
            'navLink' => 'data-penyakit',
        ];

        return view('Backend.pages.data-penyakit.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Penyakit $penyakit, Request $request)
    {
        $validateReq = $request->validate([
            'kode_penyakit' => 'required|unique:tabel_data_penyakit',
            'nama_penyakit' => 'required'
        ]);

        $solusiPenyakit = $request->get('solusi_penyakit');
        if ($solusiPenyakit == null) {
            return back()->withInput()->with('errorInput', 'Anda belum mengisi solusi penyakit');
        }

        $penyakit->kode_penyakit = $validateReq['kode_penyakit'];
        $penyakit->nama_penyakit = $validateReq['nama_penyakit'];
        $penyakit->solusi = json_encode($solusiPenyakit);
        $penyakit->save();

        return redirect()->to('data-penyakit')->with('success', 'Data Penyakit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit($data_penyakit, Penyakit $penyakit)
    {
        $dataPenyakit = $penyakit->find($data_penyakit)->toArray();

        $datas = [
            'titlePage' => 'Data Penyakit',
            'navLink' => 'data-penyakit',
            'idPenyakit' => $dataPenyakit['id_penyakit'],
            'dataPenyakit' => $dataPenyakit
        ];

        return view('Backend.pages.data-penyakit.edit', $datas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update($data_penyakit, Request $request, Penyakit $penyakit)
    {
        $validateReq = $request->validate([
            'kode_penyakit' => 'required',
            'nama_penyakit' => 'required'
        ]);

        $solusiPenyakit = $request->get('solusi_penyakit');
        if ($solusiPenyakit == null) {
            return back()->withInput()->with('errorInput', 'Anda belum mengisi solusi penyakit');
        }

        $dataPenyakit = $penyakit->find($data_penyakit);
        $dataPenyakit->kode_penyakit = $validateReq['kode_penyakit'];
        $dataPenyakit->nama_penyakit = $validateReq['nama_penyakit'];
        $dataPenyakit->solusi = json_encode($solusiPenyakit);
        $dataPenyakit->save();

        return redirect()->to('data-penyakit')->with('success', 'Data Penyakit berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy($data_penyakit, Penyakit $penyakit)
    {
        $dataPenyakit = $penyakit->find($data_penyakit);
        $dataPenyakit->delete();

        return redirect()->to('data-penyakit')->with('success', 'Data Penyakit berhasil dihapus');
    }
}
