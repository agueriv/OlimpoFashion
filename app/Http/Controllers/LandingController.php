<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{

    function __construct()
    {
        $this->middleware('auth')->only('almacen');
    }

    function home()
    {
        return view('shophome');
    }

    function almacen()
    {
        $secciones = ['h' => 'Hombre', 'm' => 'Mujer', 'n' => 'Niños', 'all' => 'Unisex'];
        $temporadas = ['pri-ver' => 'Primavera/Verano', 'oto-inv' => 'Otoño/Invierno', 'all' => 'Todo el año'];
        $totalArticulos = Articulo::all()->count();
        $totalPrecioArt = 0;
        $totalCats = Categoria::all()->count();
        $arts = Articulo::all();
        foreach ($arts as $art) {
            if ($art->en_rebaja == 1) {
                $totalPrecioArt = $totalPrecioArt + $art->precio_rebaja;
            } else {
                $totalPrecioArt = $totalPrecioArt + $art->precio;
            }
        }
        $lastCats = DB::table('categoria')
            ->where('created_at', '>=', Carbon::now()->subWeek())->get();
        $artsLastWeek = DB::table('articulo')->select(
            'articulo.id AS id',
            'articulo.nombre AS nombre',
            'articulo.seccion AS seccion',
            'articulo.temporada AS temporada',
            'articulo.picture AS picture',
            'articulo.en_rebaja AS en_rebaja',
            'articulo.precio AS precio',
            'articulo.precio_rebaja AS precio_rebaja',
            'articulo.descripcion AS descripcion',
            'categoria.nombre AS categoria',
        )
            ->join('categoria', 'articulo.idcategoria', '=', 'categoria.id')
            ->where('articulo.created_at', '>=', Carbon::now()->subWeek())->get();

        return view('almacen.home', [
            'totalArt' => $totalArticulos,
            'totalPrecioArts' => $totalPrecioArt,
            'totalCats' => $totalCats,
            'lastArts' => $artsLastWeek,
            'secciones' => $secciones,
            'temporadas' => $temporadas,
            'lastCats' => $lastCats
        ]);
    }
}
