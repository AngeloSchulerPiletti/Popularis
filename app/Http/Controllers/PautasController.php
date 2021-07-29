<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PautasController extends Controller
{
    public function index()
    {
    }


    // -----------------POR ESCOPO----------------\\
    /** Federal */
    public function federal_all()
    {
        dd("federal");
    }
    public function federal($type)
    {
        dd($type);
    }


    /** Estadual */
    public function estadual_all()
    {
        dd("estadual");
    }
    public function estadual($type)
    {
        dd($type);
    }
}
