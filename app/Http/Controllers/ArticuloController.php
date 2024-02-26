<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticuloCreateRequest;
use App\Http\Requests\ArticuloEditRequest;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('almacen.articulo.index');
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
