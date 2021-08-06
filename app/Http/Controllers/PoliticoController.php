<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PoliticoController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/Politico');
    }
}
