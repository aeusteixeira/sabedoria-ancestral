<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementMapController extends Controller
{
    public function index()
    {
        return view('website.elementos.index');
    }
}
