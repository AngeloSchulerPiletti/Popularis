<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PautaController extends Controller
{
    public function show($url, Request $request){
        $props = null !== $request->session()->get('status') ? $request->session()->get('status') : [];

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
            return Inertia::render('public/Pautas/PautaModel', ['status' => $props, 'pauta' => $pauta, 'votou' => $votou]);
        }
        abort(404);
    }

    public function store($url, Request $request){
        $pauta = DB::table('pautas')->where('url', $url)->first();
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        $type = $request->voto;
        $vote_type = $type."_votes";
        $actual_votes = $pauta->$vote_type;
        $actual_votes++;

        DB::table('pautas')->where('url', $url)->update([$vote_type => $actual_votes]);
        DB::table('users')->where('id', Auth::user()->id)->update([$vote_type => $user->$vote_type.$pauta->id."-"]);

        return redirect(route('pauta.show', ['url' => $url]))->with('status', [0 => 'Seu voto foi registrado com sucesso!', 1=> 'Você pode verificá-lo no seu histórico']);
    
    }
}
