<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    const ORDERBY = 'articulo.id';
    const ORDERTYPE = 'asc';
    function give_producto(Request $request)
    {
        $orderby = $request->orderby;
        $ordertype = $request->ordertype;

        if ($orderby == null)
            $orderby = self::ORDERBY;
        if ($ordertype == null)
            $ordertype = self::ORDERTYPE;

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

        if ($request->q != null) {
            $artQuery->where('articulo.seccion', 'like', '%' . $request->q . '%')
                ->orWhere('articulo.id', 'like', '%' . $request->q . '%')
                ->orWhere('articulo.nombre', 'like', '%' . $request->q . '%')
                ->orWhere('articulo.temporada', 'like', '%' . $request->q . '%')
                ->orWhere('articulo.precio', 'like', '%' . $request->q . '%')
                ->orWhere('articulo.precio_rebaja', 'like', '%' . $request->q . '%')
                ->orWhere('articulo.descripcion', 'like', '%' . $request->q . '%')
                ->orWhere('categoria.nombre', 'like', '%' . $request->q . '%');
        }

        if ($request->seccion != null) {
            $artQuery->where('articulo.seccion', 'like', '%' . $request->seccion . '%');
        }
        if ($request->categoria != null) {
            $artQuery->where('categoria.nombre', 'like', '%' . $request->categoria . '%');
        }

        if ($request->temporada != null) {
            $artQuery->where('articulo.temporada', 'like', '%' . $request->temporada . '%');
        }

        $articles = $artQuery->orderBy($orderby, $ordertype)->paginate(8);
        return response()->json($articles);
    }

    function give_categorias()
    {
        // Obtenemos la lista de categorías mas usadas
        $categorias = Categoria::withCount('articulos')
            ->orderBy('articulos_count', 'desc')
            ->take(6)
            ->get();
        return response()->json($categorias);
    }
}
