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
        $this->middleware('auth');
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
        $colors = ['primary', 'success', 'info', 'warning'];

        $order = $orderBy . '.' . $orderType;

        return view('almacen.categoria.index', [
            'categorias' => $categorias,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => self::getRpp(),
            'rpp' => $rpp,
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
            $target = 'almacen/categoria';
            return redirect($target)->with(['message' => 'Categoría creada correctamente.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'La categoría no ha sido creada correctamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Categoria $categoria)
    {
        $rpp = $request->rpp != null ? $request->rpp : 6;
        $orderBy = 'nombre';
        $orderType = self::getFromRequest($request, 'orderType', self::ORDERTYPE);
        $q = $request->q;

        $articulosQ = DB::table('articulo')->where('idcategoria', $categoria->id)->select('id', 'nombre', 'descripcion', 'picture');

        if ($q != null) {
            $articulosQ = $articulosQ->where(function ($query) use ($q) {
                $query->where('nombre', 'like', '%' . $q . '%');
            });
        }
        
        $rpps = [3 => 3, 6 => 6, 12 => 12, 24 => 24, 32 => 32];

        $articulos = $articulosQ->orderBy($orderBy, $orderType)->paginate($rpp);
        return view('almacen.categoria.show', [
            'cat' => $categoria,
            'articulos' => $articulos,
            'rpp' => $rpp,
            'orderBy' => $orderBy,
            'orderType' => $orderType,
            'q' => $q,
            'rpps' => $rpps
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('almacen.categoria.edit', ['cat' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaEditRequest $request, Categoria $categoria)
    {
        try {
            $categoria->update($request->all());
            return redirect('almacen/categoria')->with(['message' => 'Categoría editada con éxito.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se ha podido editar la categoría.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect('almacen/categoria')->with(['message' => 'Categoría eliminada con éxito.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'No se ha podido eliminar la categoría.']);
        }
    }
}
