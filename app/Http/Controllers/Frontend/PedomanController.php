<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedomanController extends Controller
{
    public function index()
    {
        $datas = [
            'titlePage' => 'Pedoman',
            'navLink' => 'pedoman'
        ];

        return view('Frontend.pages.pedoman', $datas);
    }
}
