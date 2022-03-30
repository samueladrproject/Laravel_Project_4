<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $datas = [
            'titlePage' => 'Home',
            'navLink' => 'home'
        ];

        return view('Frontend.pages.home', $datas);
    }
}
