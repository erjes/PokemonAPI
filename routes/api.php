<?php

use App\Http\Controllers\pokemonController;
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
Route::get('pokemons', [pokemonController::class, 'index']);
Route::post('pokemon/catch', [pokemonController::class, 'catch']);
Route::delete('pokemon/release/{id}', [pokemonController::class, 'release']);
Route::put('pokemon/rename/{id}', [pokemonController::class, 'rename']);
