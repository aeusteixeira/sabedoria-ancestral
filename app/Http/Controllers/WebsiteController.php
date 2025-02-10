<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('website.index');
    }

    public function horaPlanetaria()
    {
        return view('website.hora-planetaria');
    }

    public function calendarioLunar()
    {
        return view('website.calendario-lunar');
    }

    public function planetas()
    {
        return view('website.planetas');
    }

    public function ervas()
    {
        return view('website.ervas');
    }

    public function erva(){
     return view('website.erva');
    }

    public function sobre()
    {
        return view('website.sobre');
    }

}
