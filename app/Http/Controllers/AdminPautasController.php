<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class AdminPautasController extends Controller
{
    public function create_pauta(Request $request)
    {
        $request->validate([
            'titulo'         => 'required|string|max:150',
            'assunto'        => 'required|string|max:20',
            'autores'        => 'required|string|',
            'palavras_chave' => 'required|string|max:800',
            'resumo'         => 'required|string|max:1000',
            'pauta'          => 'required|string',
        ]);

        dd('criando pauta');
    }
}
