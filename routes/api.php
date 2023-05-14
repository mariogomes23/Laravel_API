<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("login",[LoginController::class,"login"]);

Route::middleware("auth:jwt")->prefix("v1")->group(function(){
Route::apiResource("categoria",CategoriaController::class);
Route::apiResource("produto",ProdutoController::class);
Route::get("categoria/{id}/produtos",[CategoriaController::class,"produtos"]);

});
