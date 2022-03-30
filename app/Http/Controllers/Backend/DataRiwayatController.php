<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use App\Models\Hasil;
use Illuminate\Http\Request;

class DataRiwayatController extends Controller
{
    public function index()
    {
        $datas = [
            'titlePage' => 'Data Riwayat',
            'navLink' => 'data-riwayat',
            'dataDiagnosa' => Diagnosa::all()
        ];

        return view('Backend.pages.data-riwayat.index', $datas);
    }

    public function showdata($id_diagnosa)
    {
        $dataDiagnosa = Diagnosa::find($id_diagnosa)->toArray();

        $dataTampilan = [
            'titlePage' => 'Hasil Diagnosa',
            'navLink' => 'diagnosa',
            'namaPemilik' => $dataDiagnosa['nama_pemilik'],
            'diagnosa' => json_decode($dataDiagnosa['diagnosa']),
            'solusi' => json_decode($dataDiagnosa['solusi'])
        ];

        return view('Backend.pages.data-riwayat.hasil', $dataTampilan);
    }

    public function destroy($id_diagnosa)
    {
        $dataDiagnosa = Diagnosa::find($id_diagnosa);
        $dataDiagnosa->delete();

        return redirect()->to('data-riwayat')->with('success', 'Data Riwayat Berhasil Dihapus');
    }
}
