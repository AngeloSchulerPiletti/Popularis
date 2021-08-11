<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PautaController extends Controller
{
    public function show($url){
        $pauta = DB::table('pautas')->where('url', $url)->first();

        $his_neg = Auth::user()->neg_votes;
        $his_pos = Auth::user()->pos_votes;
        $votes = implode("", [$his_pos, $his_neg]);
        $votes = explode("-", $votes);

        $votou = false;
        foreach ($votes as $id) {
            if($id == $pauta->id){
                $votou = true;
                break;
            }    
        }

        if($pauta && $pauta->status == 3){
            return Inertia::render('public/Pautas/PautaModel', ['pauta' => $pauta, 'votou' => $votou]);
        }
        abort(404);
    }

    public function store($url, Request $request){
        dd($url, $request->voto);
    }
}
