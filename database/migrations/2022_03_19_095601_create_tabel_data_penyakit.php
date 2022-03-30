<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTabelDataPenyakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_data_penyakit', function (Blueprint $table) {
            $table->id('id_penyakit');
            $table->string('kode_penyakit')->unique();
            $table->string('nama_penyakit');
            $table->longText('solusi');
            $table->timestamps();
        });

        $insertedData = [
            [
                'kode_penyakit' => 'P01',
                'nama_penyakit' => 'Cacing Hati',
                'solusi' => json_encode([
                    '- Pemberian obat cacing yang dapat membasmi cacing hati, seperti Wormection plus/Wormection Plus-B;',
                    '- Pemberian multivitamin seperti ADE-Plexinj/ Injeksi Vitamin B Kompleks;',
                    '- Melakukan sanitasi kandang dan peternakan dengan membersihkan, mencuci dan menyemprot, dengan desinfektan (Neo antisep, Medisep) setiap hari.'
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kode_penyakit' => 'P02',
                'nama_penyakit' => 'Cacing Gilig',
                'solusi' => json_encode([
                    '- Pemberian obat cacing yang dapat memberantas cacing gilig, yaitu Wormzolk;',
                    '- Melakukan sanitasi kandang dan peternakan dengan membersihkan, mencuci dan menyemprot, dengan desinfektan (Neo antisep, Medisep atau Formades untuk kandang kosong) setiap hari;',
                    '- Memberikan antibiotik;',
                    '- Pada pakan ditaburkan copper sulphate untuk mencegah perkembangan larva cacing.'
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('tabel_data_penyakit')->insert($insertedData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_data_penyakit');
    }
}
