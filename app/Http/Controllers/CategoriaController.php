<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaCreateRequest;
use App\Http\Requests\CategoriaEditRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    const RPP = 4;
    const ORDERBY = 'categoria.id';
    const ORDERTYPE = 'asc';
    const PARAMS = [
        'rpp' => [
            self::RPP => self::RPP,
            8 => 0,
            16 => 0,
            32 => 0,
            64 => 0
        ],
        'orderBy' => [
            self::ORDERBY => self::ORDERBY,
            'categoria.nombre' => 0,
        ],
        'orderType' => [
            self::ORDERTYPE => self::ORDERTYPE,
            'desc' => 0
        ]
    ];
    public function __construct()
    {
        // Middlewares
    }

    public function index(Request $request)
    {
        $rpp = self::getFromRequest($request, 'rpp', self::RPP);
        $orderBy = self::getFromRequest($request, 'orderBy', self::ORDERBY);
        $orderType = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = $request->q;

        $catQuery = DB::table('categoria')
            ->select(
                'categoria.id AS id',
                'categoria.nombre AS nombre'
            );

        // Comprobamos la query (q)
        if ($q != null) {
            $catQuery = $catQuery->where('categoria.id', 'like', '%' . $q . '%')
                ->orWhere('categoria.nombre', 'like', '%' . $q . '%');
        }

        $categorias = $catQuery->orderBy($orderBy, $orderType)
            ->orderBy(self::ORDERBY, self::ORDERTYPE)
            ->paginate($rpp);

        // Recuento total de modulos
        $count_query = DB::select('select count(*) as cat_count from categoria');
        $cat_count = $count_query[0]->cat_count;

        // Recuento de modulos mostrados
        if ($categorias->currentPage() === 1) {
            $init_cat = 1;
            $last_cat_page = $categorias->perPage();
        } else {
            $last_mod_page = $categorias->currentPage() * $categorias->perPage();
            if ($cat_count < $last_mod_page) {
                $last_cat_page = $cat_count;
            }
            $init_cat = ($categorias->currentPage() * $categorias->perPage()) - $categorias->perPage();
        }

        $colors = ['primary', 'success', 'info', 'warning'];

        $order = $orderBy . '.' . $orderType;

        return view('almacen.categoria.index', [
            'categorias' => $categorias,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
            'cat_count' => $cat_count,
            'init_cat' => $init_cat,
            'last_cat_page' => $last_cat_page,
            'colors' => $colors,
            'order' => $order
        ]);
    }

    private static function getRpp()
    {
        return [4 => 4, 8 => 8, 16 => 16, 32 => 32, 64 => 64];
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
        return view('almacen.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaCreateRequest $request)
    {
        $object = new Categoria($request->all());

        try {
            $result = $object->save();
            // Donde redirigirá después de crear
            $target = 'almacen/categoria/' . $object->id;
            return redirect($target)->with(['message' => 'Categoría creada correctamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'La categoría no ha sido creada correctamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('almacen.categoria.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('almacen.categoria.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaEditRequest $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
