<?php

use App\Http\Controllers\PaisesController;
use App\Http\Controllers\PessoasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Pessoas
Route::get('/pessoas', [PessoasController::class, 'index'])->name('pessoas.index');
Route::post('/pessoas/store', [PessoasController::class, 'store'])->name('pessoas.store');
Route::put('/pessoas/update', [PessoasController::class, 'update'])->name('pessoas.update');
Route::delete('/pessoas/destroy', [PessoasController::class, 'destroy'])->name('pessoas.destroy');

// Paises
Route::get('/paises', [PaisesController::class, 'index'])->name('paises.index');
