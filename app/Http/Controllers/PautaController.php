<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PautaController extends Controller
{
    public function show($url, Request $request){
        $props = null !== $request->session()->get('status') ? $request->session()->get('status') : [];

        $pauta = DB::table('pautas')->where('url', $url)->first() !== null ? DB::table('pautas')->where('url', $url)->first() : abort(404);

        $his_neg = Auth::user()->neg_votes;
        $his_pos = Auth::user()->pos_votes;
        $votes = implode("", [$his_pos, $his_neg]);
        $votes = explode("-", $votes);

        $cannot_vote = false;
        foreach ($votes as $id) {
            if($id == $pauta->id || $pauta->status == 1){
                $cannot_vote = true;
                break;
            }    
        }
        
        if($pauta && (in_array($pauta->status, [1, 2, 3]))){
            return Inertia::render('public/Pautas/PautaModel', ['status' => $props, 'pauta' => $pauta, 'votou' => $cannot_vote]);
        }
        else if($pauta->status == 4){
            return Inertia::render('public/Unavailable', ['suggestions' => ['Página Inicial' => route('inicio'), 'Voltar para página anterior' => URL::previous() ], 'page_config' => ['Essa pauta ainda não está disponível', 'Essa pauta não está disponível porque aguarda aprovação do técnico. Para entender mais acesso nosso FAQ.']]);
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
