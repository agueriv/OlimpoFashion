<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    function home() {
        return view('home');
    }

    function almacen() {
        return view('almacen.home');
    }
}
