<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'home'])->name('front.home');
Route::get('/almacen', [LandingController::class, 'almacen'])->name('almacen');

Route::resource('almacen/admin', AdminController::class);
Route::resource('almacen/articulo', ArticuloController::class);
Route::resource('almacen/categoria', CategoriaController::class, [
    'parameters' => ['categoria' => 'categoria']
]);

Route::prefix('almacen')->group(function () {
    Auth::routes(['verify' => false, 'register' => false]);
});

// Ruta para obtener productos
Route::get('producto', [ShopController::class, 'give_producto'])->name('producto');