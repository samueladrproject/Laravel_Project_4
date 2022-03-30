<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BasisPengetahuan;
use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $datas = [
            'titlePage' => 'Diagnosa',
            'navLink' => 'diagnosa',
            'dataGejala' => Gejala::all()
        ];

        return view('Frontend.pages.diagnosa', $datas);
    }

    public function showdata($data_diagnosa)
    {
        $dataDiagnosa = Diagnosa::find($data_diagnosa)->toArray();

        $dataTampilan = [
            'titlePage' => 'Hasil Diagnosa',
            'navLink' => 'diagnosa',
            'namaPemilik' => $dataDiagnosa['nama_pemilik'],
            'diagnosa' => json_decode($dataDiagnosa['diagnosa']),
            'solusi' => json_decode($dataDiagnosa['solusi'])
        ];

        return view('Frontend.pages.hasildiagnosa', $dataTampilan);
    }

    public function kalkulator(Request $request)
    {
        $validateReq = $request->validate([
            'nama_pemilik' => 'required',
        ]);

        $arrHasilUser = $request->input('resultGejala');

        if ($arrHasilUser == null) {
            return back()->withInput()->with('error', 'Anda belum memilih gejala');
        } else {
            if (count($arrHasilUser) < Penyakit::count() + 1) {
                return back()->withInput()->with('error', 'Minimal gejala yang dipilih adalah ' . (Penyakit::count() + 1) . ' gejala');
            } else {
                foreach ($arrHasilUser as $key => $value) {
                    $dataPenyakit[$key] = BasisPengetahuan::where('kode_gejala', $value)
                        ->select('kode_penyakit')
                        ->get()
                        ->toArray();
                    foreach ($dataPenyakit[$key] as $a => $b) {
                        $resultData[$key]['daftar_penyakit'][$a] = $b['kode_penyakit'];
                    }
                    $dataNilaiDensitas[$key] = Gejala::where('kode_gejala', $value)
                        ->select('nilai_densitas', 'gejala')
                        ->get()
                        ->toArray();
                    $dataGejala[$key] = $dataNilaiDensitas[$key][0]['gejala'];
                    $resultData[$key]['belief'] = $dataNilaiDensitas[$key][0]['nilai_densitas'];
                    $resultData[$key]['plausibility'] = 1 - $dataNilaiDensitas[$key][0]['nilai_densitas'];
                }

                $variabelTampilan = $this->mulaiPerhitungan($resultData);

                foreach ($dataGejala as $key => $value) {
                    $variabelTampilan['Gejala_Penyakit'][$key]['kode_gejala'] = $arrHasilUser[$key];
                    $variabelTampilan['Gejala_Penyakit'][$key]['nama_gejala'] = $value;
                }

                $diagnosaSavedData = [
                    'nama_penyakit' => $variabelTampilan['Nama_Penyakit']['nama_penyakit'],
                    'nilai_belief' => $variabelTampilan['Nilai_Belief_Penyakit'],
                    'persentase_penyakit' => $variabelTampilan['Persentase_Penyakit'],
                    'gejala_penyakit' => $variabelTampilan['Gejala_Penyakit']
                ];

                $diagnosa = new Diagnosa();
                $diagnosa->nama_pemilik = $validateReq['nama_pemilik'];
                $diagnosa->diagnosa = json_encode($diagnosaSavedData);
                $diagnosa->solusi = json_encode($variabelTampilan['Solusi_Penyakit']);
                $diagnosa->save();
                $idDiagnosa = $diagnosa->id_diagnosa;

                return redirect()->to('diagnosa/' . $idDiagnosa);
            }
        }
    }

    public function mulaiPerhitungan($dataAcuan)
    {
        $x = 0;
        for ($i = 0; $i < count($dataAcuan); $i++) {
            $hasilKonversi[$i]['data'][0]['array'] = $dataAcuan[$i]['daftar_penyakit'];
            $hasilKonversi[$i]['data'][0]['value'] = $dataAcuan[$i]['belief'];
            $hasilKonversi[$i]['data'][1]['array'] = [];
            $hasilKonversi[$i]['data'][1]['value'] = $dataAcuan[$i]['plausibility'];

            $x++;
        }

        $result = $this->startingPoint(count($hasilKonversi) - 2, $hasilKonversi);

        $arrResult = [];
        foreach ($result['data'] as $key => $value) {
            $arrResult[$key] = $value['value'];
        }

        $indexMaxValue = array_search(max($arrResult), $arrResult);
        $nilaiBelief = round($result['data'][$indexMaxValue]['value'], 2);
        $persentase = (round($result['data'][$indexMaxValue]['value'], 2) * 100) . " %";

        $kodePenyakit = $result['data'][$indexMaxValue]['array'][0];
        $dataPenyakit = Penyakit::where('kode_penyakit', $kodePenyakit)
            ->select('nama_penyakit')
            ->get()
            ->toArray()[0];
        $dataSolusi = Penyakit::where('kode_penyakit', $kodePenyakit)
            ->select('solusi')
            ->get()
            ->toArray()[0];

        $jsonData = [
            'Nama_Penyakit' => $dataPenyakit,
            'Nilai_Belief_Penyakit' => $nilaiBelief,
            'Persentase_Penyakit' => $persentase,
            'Solusi_Penyakit' => $dataSolusi,
        ];

        return $jsonData;
    }

    public function startingPoint(int $jumlah, array $myData, $data = [], int $indeks = 0)
    {
        if (count($data) == 0) {
            $hasilAkhir = $this->kalkulatorPerhitungan($myData[$indeks], $myData[$indeks + 1]);
        } else {
            $hasilAkhir = $this->kalkulatorPerhitungan($data, $myData[$indeks + 1]);
        }

        if ($indeks < $jumlah) {
            return $this->startingPoint($jumlah, $myData, $hasilAkhir, $indeks + 1);
        } else {
            return $hasilAkhir;
        }
    }

    public function kalkulatorPerhitungan($array1, $array2)
    {
        $hasilAkhir['data'] = [];

        $hasilSementara = [];
        $z = 0;
        for ($x = 0; $x < count($array1['data']); $x++) {
            for ($y = 0; $y < count($array2['data']); $y++) {
                if (count($array1['data'][$x]['array']) != 0 && count($array2['data'][$y]['array']) != 0) {
                    $hasilSementara[$z]['array'] = json_encode(array_values(array_intersect($array1['data'][$x]['array'], $array2['data'][$y]['array'])));
                    if (count(json_decode($hasilSementara[$z]['array'])) == 0) {
                        $hasilSementara[$z]['status'] = "Himpunan Kosong";
                    }
                } else {
                    $hasilSementara[$z]['array'] = json_encode(array_merge($array1['data'][$x]['array'], $array2['data'][$y]['array']));
                }
                $hasilSementara[$z]['value'] = $array1['data'][$x]['value'] * $array2['data'][$y]['value'];
                $z++;
            }
        }

        $pushArray = [];
        foreach ($hasilSementara as $hasil) {
            array_push($pushArray, $hasil['array']);
        }

        $pushArrayCat = [];
        foreach (array_count_values($pushArray) as $key => $value) {
            array_push($pushArrayCat, $key);
        }

        $tetapan = 0;
        foreach ($hasilSementara as $datahasil) {
            if (isset($datahasil['status']) && $datahasil['status'] == "Himpunan Kosong") {
                $tetapan += $datahasil['value'];
            }
        }

        $tetapan = 1 - $tetapan;

        $finalResult = [];
        for ($y = 0; $y < count($pushArrayCat); $y++) {
            $decode[$y] = json_decode($pushArrayCat[$y]);
            $finalResult[$y]['array'] = $decode[$y];
            $finalResult[$y]['value'] = 0;
            for ($x = 0; $x < count($hasilSementara); $x++) {
                $array[$x] = json_decode($hasilSementara[$x]['array']);
                if ($decode[$y] == $array[$x]) {
                    if (!isset($hasilSementara[$x]['status'])) {
                        $finalResult[$y]['value'] += $hasilSementara[$x]['value'];
                    }
                }
            }
            $finalResult[$y]['value'] = $finalResult[$y]['value'] / $tetapan;
        }

        for ($i = 0; $i < count($finalResult); $i++) {
            $hasilAkhir['data'][$i] = $finalResult[$i];
        }

        return $hasilAkhir;
    }
}
