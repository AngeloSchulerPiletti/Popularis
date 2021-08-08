<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class AdminPautasController extends Controller
{
    public function create_pauta(Request $request){
        // $request->validate([
        //     'titulo' => 'required|string'
        // ]);

        dd('criando pauta');
    }
}
