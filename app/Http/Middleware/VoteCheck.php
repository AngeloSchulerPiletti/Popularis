<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteCheck
{
    /**
     * Para caso de tentativa de voto duplo
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $pauta_url = explode('/', $request->getRequestUri())[2];
        $pauta = DB::table('pautas')->where('url', $pauta_url)->first();

        $his_neg = Auth::user()->neg_votes;
        $his_pos = Auth::user()->pos_votes;
        $votes = implode("", [$his_pos, $his_neg]);
        $votes = explode("-", $votes);

        foreach ($votes as $id) {
            if($id == $pauta->id){
                abort(403);
            }    
        }
        return $next($request);
    }
}
