<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloCreateRequest;
use App\Http\Requests\ArticuloEditRequest;
use App\Models\Articulo;
use App\Models\Categoria;
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
        $this->middleware('auth');
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

        // SELECTS 
        $secciones = ['h' => 'Hombre', 'm' => 'Mujer', 'n' => 'Niños', 'all' => 'Unisex'];
        $temporadas = ['pri-ver' => 'Primavera/Verano', 'oto-inv' => 'Otoño/Invierno', 'all' => 'Todo el año'];

        // order
        $order = $orderBy . '.' . $orderType;
        return view('almacen.articulo.index', [
            'articulos' => $articulos,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'secciones' => $secciones,
            'temporadas' => $temporadas,
            'order' => $order
        ]);
    }

    private static function getRpp()
    {
        return [
            3 => 3,
            6 => 6,
            12 => 12,
            24 => 24,
            32 => 32,
            64 => 64,
            128 => 128
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
        // SELECTS 
        $categorias = Categoria::all();
        $secciones = ['h' => 'Hombre', 'm' => 'Mujer', 'n' => 'Niños', 'all' => 'Unisex'];
        $temporadas = ['pri-ver' => 'Primavera/Verano', 'oto-inv' => 'Otoño/Invierno', 'all' => 'Todo el año'];

        return view('almacen.articulo.create', [
            'categorias' => $categorias,
            'secciones' => $secciones,
            'temporadas' => $temporadas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticuloCreateRequest $request)
    {
        $art = new Articulo();
        $art->nombre = $request->nombre;
        $art->seccion = $request->seccion;
        $art->descripcion = $request->descripcion;
        $art->temporada = $request->temporada;
        $art->idcategoria = $request->categoria;
        $art->en_rebaja = $request->en_rebaja;
        $art->precio = $request->precio;
        $art->precio_rebaja = $request->precio_rebaja;

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $archivo = $request->file('picture');
            $path = $archivo->getRealPath();
            $imagen = file_get_contents($path);

            $art->picture = base64_encode($imagen);
        }
        try {
            $result = $art->save();
            // Donde redirigirá después de crear
            $target = 'almacen/articulo';
            return redirect($target)->with(['message' => 'Artículo creado correctamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El artículo no ha sido creado correctamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        $categorias = Categoria::all();
        $secciones = ['h' => 'Hombre', 'm' => 'Mujer', 'n' => 'Niños', 'all' => 'Unisex'];
        $temporadas = ['pri-ver' => 'Primavera/Verano', 'oto-inv' => 'Otoño/Invierno', 'all' => 'Todo el año'];

        return view('almacen.articulo.show', [
            'art' => $articulo,
            'categorias' => $categorias,
            'secciones' => $secciones,
            'temporadas' => $temporadas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        // SELECTS 
        $categorias = Categoria::all();
        $secciones = ['h' => 'Hombre', 'm' => 'Mujer', 'n' => 'Niños', 'all' => 'Unisex'];
        $temporadas = ['pri-ver' => 'Primavera/Verano', 'oto-inv' => 'Otoño/Invierno', 'all' => 'Todo el año'];

        return view('almacen.articulo.edit', [
            'art' => $articulo,
            'categorias' => $categorias,
            'secciones' => $secciones,
            'temporadas' => $temporadas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticuloEditRequest $request, Articulo $articulo)
    {
        try {
            $articulo->nombre = $request->nombre;
            $articulo->seccion = $request->seccion;
            $articulo->descripcion = $request->descripcion;
            $articulo->temporada = $request->temporada;
            $articulo->idcategoria = $request->categoria;
            $articulo->en_rebaja = $request->en_rebaja;
            $articulo->precio = $request->precio;
            $articulo->precio_rebaja = $request->precio_rebaja;

            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $archivo = $request->file('picture');
                $path = $archivo->getRealPath();
                $imagen = file_get_contents($path);

                $articulo->picture = base64_encode($imagen);
            }

            $articulo->save();

            return redirect('almacen/articulo')->with(['message' => 'Artículo editado con éxito.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se ha podido editar el artículo.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo)
    {
        try {
            $articulo->delete();
            return redirect('almacen/articulo')->with(['message' => 'Artículo eliminado con éxito.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se ha podido eliminar el artículo.']);
        }
    }
}
