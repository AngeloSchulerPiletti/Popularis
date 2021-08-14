<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PautasController;
use App\Http\Controllers\PautaController;
use App\Http\Controllers\PoliticoController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\AdminPautasController;
use App\Http\Controllers\PaginationController;

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

    Route::get('/{section}',           [PautasController::class, 'show_section'])->name('section.show');
    Route::get('/{section}/{type}',    [PautasController::class, 'show_section_type'])->name('section.type.show');
});


//----------------------------- PAUTA ------------------------------\\
Route::middleware('auth')->get('/pauta/{url}',                          [PautaController::class, 'show'])->name('pauta.show');
Route::middleware(['auth', 'has_votted'])->post('/pauta/{url}',         [PautaController::class, 'store'])->name('pauta.store');

Route::post('/paginacao',    [PaginationController::class, 'index'])->name('pagination.load');



//----------------------------- TÉCNICO ------------------------------\\
Route::group(['middleware' => 'tecnico', 'as' => 'tecnico.', 'prefix' => 'area-do-tecnico'], function () {
    Route::get('/',                    [TecnicoController::class, 'index'])->name('requisicoes.show');
    Route::get('/requisicoes',         [TecnicoController::class, 'index'])->name('requisicoes_default.show');

    Route::get('/bugs',                [TecnicoController::class, 'bugs_show'])->name('bugs.show');


    //POST routes\\
    Route::post('/pauta-aceita',       [TecnicoController::class, 'pauta_accepted'])->name('pauta.accepted');
    Route::post('/pauta-negada',       [TecnicoController::class, 'pauta_denied'])->name('pauta.denied');

});

//----------------------------- POLÍTICO ------------------------------\\
Route::group(['middleware' => 'politico', 'as' => 'politico.', 'prefix' => 'area-do-politico'], function () {
    Route::get('/',                     [PoliticoController::class, 'pauta_create_show'])->name('pauta_create.show');
    Route::get('/criar-pauta',          [PoliticoController::class, 'pauta_create_show'])->name('pauta_create_default.show');

    Route::get('/estatisticas',         [PoliticoController::class, 'estatisticas_show'])->name('estatisticas.show');
    Route::get('/historico-de-pautas',  [PoliticoController::class, 'historico_pautas_show'])->name('historico_pautas.show');
    Route::get('/gerenciar-equipe',     [PoliticoController::class, 'gerenciar_equipe_show'])->name('gerenciar_equipe.show');
    

    //POST routes\\
    Route::post('/criar-pauta', [AdminPautasController::class, 'create_pauta'])->name('create_pauta');
});



