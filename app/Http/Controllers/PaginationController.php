<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminPautasController;

class PaginationController extends Controller
{
    public function index(Request $request)
    {
        $parsed_url = explode('/', URL::previous());
        $type = isset($parsed_url[5]) ? $parsed_url[5] : false;
        $section = $parsed_url[4];

        $request->validate([
            'perpage' => 'required|integer',
            'actual_page' => 'required|integer',
            'from_search' => 'required|boolean',
        ]);
        $perpage = $request->perpage;
        $actualpage = $request->actual_page;

        if ($type == "meus-votos") {
            $votes = Auth::user()->neg_votes.Auth::user()->pos_votes;
            $votes_id = explode('-', $votes);

            $total_pautas = count(DB::table('pautas')->whereIn('id', $votes_id)->get());
            $db_data = DB::table('pautas')->whereIn('id', $votes_id)->skip($perpage * $actualpage - $perpage)->take($perpage)->get();

            return redirect(route('profile.votes'))->with('pagination', [$db_data, $total_pautas]);
        }
        else if($request->from_search){
            $keywords = urldecode($section);
            $breaked_keywords = AdminPautasController::stringToURL($keywords);
            $keywords_arr = explode('-', $breaked_keywords);

            $pautas_founded_id = [];
            $pautas = DB::table('pautas')->where('local', Auth::user()->uf)->orWhere('escopo', 'federal')->where('status', '<', '4')->get();
           
            foreach ($pautas as $pauta) {
                $pauta_keywords = explode('-', $pauta->palavras_chave);
                foreach ($pauta_keywords as $value) {
                    foreach ($keywords_arr as $keyword) {
                        if ($keyword == $value) {
                            $pautas_founded_id[] = $pauta->id;
                        }
                    }
                }
            }
            $total_pautas = count(DB::table('pautas')->whereIn('id', $pautas_founded_id)->get());
            $pautas_to_show = DB::table('pautas')->whereIn('id', $pautas_founded_id)->skip($perpage * $actualpage - $perpage)->take($perpage)->get();

            return redirect(route('busca.show', ['keywords' => $keywords]))->with('pagination', [$pautas_to_show, $total_pautas]);
        }
        else{$status_arr = ['passadas' => 1, 'atuais' => 2, 'futuras' => 3];
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
                ->skip($perpage * $actualpage - $perpage)
                ->take($perpage)
                ->get()
                : DB::table('pautas')
                ->where('escopo', $section)
                ->where('status', $status_arr[$type])
                ->where('local', Auth::user()->uf)
                ->skip($perpage * $actualpage - $perpage)
                ->take($perpage)
                ->get();

            return redirect(route('pautas.section.type.show', ['section' => $section, 'type' => $type]))->with('pagination', [$db_data, $total_pautas]);
            
        }
    }
}
