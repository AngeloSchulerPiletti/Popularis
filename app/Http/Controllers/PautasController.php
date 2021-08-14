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

    public function show_section($section){
        dd('section '.$section);
    }
    public function show_section_type($section, $type){
        dd('type '.$section."  ".$type);
    }
}
