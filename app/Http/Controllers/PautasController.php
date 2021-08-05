<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PautasController extends Controller
{
    public function index()
    {
        return Inertia::render('public/Entenda');
    }

    const PAUTAS_TYPE = ['atuais', 'passadas', 'futuras'];

    // -----------------POR ESCOPO----------------\\
    /** Federal */
    public function federal_all()
    {
        return Inertia::render('public/Pautas/PautasAll', ['pauta_scope' => 'fed']);
    }
    public function federal($type)
    {
        foreach ($this::PAUTAS_TYPE as $value) {
            if($value == $type){
                return Inertia::render('public/Pautas/Pautas', ['pauta_scope' => 'fed', 'type' => $value]);
            }
        }
        abort(404);
    }


    /** Estadual */
    public function estadual_all()
    {
        return Inertia::render('public/Pautas/PautasAll', ['pauta_scope' => 'est']);
    }
    public function estadual($type)
    {
        foreach ($this::PAUTAS_TYPE as $value) {
            if($value == $type){
                return Inertia::render('public/Pautas/Pautas', ['pauta_scope' => 'est', 'type' => $value]);
            }
        }
        abort(404);
    }
}
