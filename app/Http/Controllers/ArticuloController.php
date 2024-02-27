<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloCreateRequest;
use App\Http\Requests\ArticuloEditRequest;
use App\Models\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticuloController extends Controller
{
    const RPP = 3;
    const ORDERBY = 'articulo.id';
    const ORDERTYPE = 'asc';
    const PARAMS = [
        'rpp' => [
            self::RPP => self::RPP,
            6 => 0,
            12 => 0,
            24 => 0,
            32 => 0,
            64 => 0,
            128 => 0
        ],
        'orderBy' => [
            self::ORDERBY => self::ORDERBY,
            'articulo.nombre' => 0,
            'articulo.seccion' => 0,
            'articulo.temporada' => 0,
            'articulo.idcategoria' => 0,
            'articulo.en_rebaja' => 0,
            'articulo.precio' => 0,
            'articulo.precio_rebaja' => 0,
            'articulo.descripcion' => 0,
        ],
        'orderType' => [
            self::ORDERTYPE => self::ORDERTYPE,
            'desc' => 0
        ]
    ];
    function __construct()
    {
        // Middlewares
    }
    public function index(Request $request)
    {
        $rpp = self::getFromRequest($request, 'rpp', self::RPP);
        $orderBy = self::getFromRequest($request, 'orderBy', self::ORDERBY);
        $orderType = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = $request->q;

        // query
        $artQuery = DB::table('articulo')
            ->select(
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
            )->join('categoria', 'articulo.idcategoria', '=', 'categoria.id');

        // Comprobamos la query (q)
        if ($q != null) {
            $artQuery = $artQuery->where('categoria.nombre', 'like', '%' . $q . '%')
                ->orWhere('articulo.nombre', 'like', '%' . $q . '%')
                ->orWhere('articulo.id', 'like', '%' . $q . '%')
                ->orWhere('articulo.seccion', 'like', '%' . $q . '%')
                ->orWhere('articulo.temporada', 'like', '%' . $q . '%')
                ->orWhere('articulo.en_rebaja', 'like', '%' . $q . '%')
                ->orWhere('articulo.precio', 'like', '%' . $q . '%')
                ->orWhere('articulo.precio_rebaja', 'like', '%' . $q . '%')
                ->orWhere('articulo.descripcion', 'like', '%' . $q . '%');
        }

        $articulos = $artQuery->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)
            ->paginate($rpp);

        return view('almacen.articulo.index', [
            'articulos' => $articulos
        ]);
    }

    private static function getRpp()
    {
        return [
            3 => 0,
            6 => 0,
            12 => 0,
            24 => 0,
            32 => 0,
            64 => 0,
            128 => 0
        ];
    }

    private static function getFromRequest($request, $name, $defaultValue)
    {
        $value = array_key_first(self::PARAMS[$name]);
        if ($request->$name != null) {
            $value = $request->$name;
        }
        if (!isset(self::PARAMS[$name][$value])) {
            $value = array_key_first(self::PARAMS[$name]);
        }
        return $value;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('almacen.articulo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticuloCreateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        return view('almacen.articulo.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        return view('almacen.articulo.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticuloEditRequest $request, Articulo $articulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo)
    {
        //
    }
}
