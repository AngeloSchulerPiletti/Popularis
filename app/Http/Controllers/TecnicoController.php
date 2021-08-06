<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TecnicoController extends Controller
{
    public function index(){
        return Inertia::render('admin/Tecnico');
    }
}
