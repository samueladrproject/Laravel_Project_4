<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    protected $table = 'tabel_diagnosa';
    protected $primaryKey = 'id_diagnosa';
    protected $fillable = [
        'nama_pemilik',
        'diagnosa',
        'solusi'
    ];
}
