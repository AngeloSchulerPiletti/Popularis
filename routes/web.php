<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PautasController;
use App\Http\Controllers\PautaController;
use App\Http\Controllers\PoliticoController;
use App\Http\Controllers\TecnicoController;

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

Route::get('/', [HomeController::class, 'index'])->name('inicio');


//------------------------------ PAUTAS ----------------------------------\\
Route::group(['as' => 'pautas.', 'prefix' => 'pautas'], function () {
    Route::get('/', [PautasController::class, 'index'])->name('all');

    Route::group(['prefix' => 'federal'], function () {
        Route::get('/',         [PautasController::class, 'federal_all'])->name('federal.all');
        Route::get('/{type}',   [PautasController::class, 'federal'])->name('federal');
    });
    Route::group(['prefix' => 'estadual'], function () {
        Route::get('/',         [PautasController::class, 'estadual_all'])->name('estadual.all');
        Route::get('/{type}',   [PautasController::class, 'estadual'])->name('estadual');
    });
});


//----------------------------- PAUTA ------------------------------\\
Route::middleware('auth')->get('/pauta/{id}',       [PautaController::class, 'show'])->name('pauta.show');



//----------------------------- TÉCNICO ------------------------------\\
Route::middleware('tecnico')->get('/area-do-tecnico', [TecnicoController::class, 'index'])->name("tecnico");

//----------------------------- POLÍTICO ------------------------------\\
Route::middleware('politico')->get('/area-do-politico', [PoliticoController::class, 'index'])->name("politico");

