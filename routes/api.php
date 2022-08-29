<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\PessoasController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Pessoas
Route::get('/pessoas', [PessoasController::class, 'index'])->name('pessoas.index');
Route::post('/pessoas/store', [PessoasController::class, 'store'])->name('pessoas.store');
Route::put('/pessoas/update', [PessoasController::class, 'update'])->name('pessoas.update');
Route::delete('/pessoas/destroy', [PessoasController::class, 'destroy'])->name('pessoas.destroy');

// Paises
Route::get('/paises', [PaisesController::class, 'index'])->name('paises.index');
