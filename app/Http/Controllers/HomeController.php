<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    protected const BASE = "public/";

    public function index(){
        return Inertia::render($this::BASE."Home");
    }
}
