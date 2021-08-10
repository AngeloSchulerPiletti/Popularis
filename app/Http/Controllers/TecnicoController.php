<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TecnicoController extends Controller
{
    public function index(){
        $pautas_to_aprove = DB::table('pautas')->where('status', 4)->get();
        $message = count($pautas_to_aprove) > 0 ? "Pautas encontradas e carregadas." : "Não há nenhuma pauta para ser aprovada!"; 

        return Inertia::render('admin/tecnico/Requisicoes', ['status' => [0 => $message], 'db_pautas' => $pautas_to_aprove]);
    }

    public function bugs_show(){
        return Inertia::render('admin/tecnico/Bugs');
    }
}
