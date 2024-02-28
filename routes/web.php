<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'home'])->name('front.home');
Route::get('/almacen', [LandingController::class, 'almacen'])->name('almacen');

Route::resource('almacen/admin', AdminController::class);
Route::resource('almacen/articulo', ArticuloController::class);
Route::resource('almacen/categoria', CategoriaController::class, [
    'parameters' => ['categoria' => 'categoria']
]);

Route::prefix('almacen')->group(function () {
    Auth::routes(['verify' => true, 'register' => false]);
});

Route::get('almacen/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');