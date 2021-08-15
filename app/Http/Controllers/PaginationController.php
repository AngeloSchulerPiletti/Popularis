<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class PaginationController extends Controller
{
    public function index(Request $request){
        $status_arr = ['passadas' => 1, 'atuais' => 2, 'futuras' => 3];

        $request->validate([
            'perpage' => 'required|integer',
            'actual_page' => 'required|integer',
        ]);
        $parsed_url = explode('/', URL::previous());
        $type = $parsed_url[5];
        $section = $parsed_url[4];

        $perpage = $request->perpage;
        $actualpage = $request->actual_page;

        $db_data_count = $section == "federal" ? DB::table('pautas')
        ->where('escopo', $section)
        ->where('status', $status_arr[$type])
        ->get()
        : DB::table('pautas')
        ->where('escopo', $section)
        ->where('status', $status_arr[$type])
        ->where('local', Auth::user()->uf)
        ->get();

        $total_pautas = count($db_data_count);
        
        $db_data = $section == "federal" ? DB::table('pautas')
                ->where('escopo', $section)
                ->where('status', $status_arr[$type])
                ->skip($perpage*$actualpage - $perpage)
                ->take($perpage)
                ->get()
                : DB::table('pautas')
                ->where('escopo', $section)
                ->where('status', $status_arr[$type])
                ->where('local', Auth::user()->uf)
                ->skip($perpage*$actualpage - $perpage)
                ->take($perpage)
                ->get();

        return redirect(route('pautas.section.type.show', ['section'=> $section, 'type'=> $type]))->with('pagination', [$db_data, $total_pautas]);
    }
}
