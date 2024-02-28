<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{

    function __construct() {
        $this->middleware('auth')->only('almacen');
    }

    function home() {
        return view('shophome');
    }

    function almacen() {
        return view('almacen.home');
    }
}
