<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TecnicoController extends Controller
{
    public function index(Request $request){
        $pautas_to_aprove = DB::table('pautas')->where('status', 4)->get();
        $message = count($pautas_to_aprove) > 0 ? "Pautas encontradas e carregadas." : "Não há nenhuma pauta para ser aprovada!"; 
        
        $props = null !== $request->session()->get('status') ? [$request->session()->get('status'), $message] : [$message];

        return Inertia::render('admin/tecnico/Requisicoes', ['status' => $props, 'db_pautas' => $pautas_to_aprove]);
    }

    public function bugs_show(){
        return Inertia::render('admin/tecnico/Bugs');
    }



    public function pauta_accepted(Request $request){
        DB::table('pautas')->where('id', $request->id)->update(['status' => 3]);

        return redirect(route('tecnico.requisicoes_default.show'))->with('status', 'Pauta aprovado com sucesso!');
    }
    public function pauta_denied(Request $request){
        dd($request);

    }
}
