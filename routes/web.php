<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/almacen', [HomeController::class, 'almacen'])->name('almacen');

Route::resource('almacen/articulo', ArticuloController::class);
Route::resource('almacen/categoria', CategoriaController::class);