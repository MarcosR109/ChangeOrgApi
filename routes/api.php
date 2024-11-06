<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PeticioneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user/{user}/address', 'show_address');
    Route::post('users/{user}/events/{event}/book', 'bookEvent');
    Route::get('users/{user}/events', 'listEvents');
});*/

Route::controller(PeticioneController::class)->group(function () {
    Route::get('peticiones', 'index');
    Route::get('peticiones/{id}', 'listMine');
    Route::get('peticiones/show/{id}', 'show');
    Route::post('peticiones/update/{id}', 'update');
    Route::post('peticiones/store', 'store');
    Route::post('peticiones/estado/{id}', 'cambiarEstado');
    Route::post('peticiones/delete/{id}', 'delete');
});

Route::controller(CategoriaController::class)->group(function () {
    Route::post('categorias', 'store');
    Route::get('categorias/show', 'show');
});

