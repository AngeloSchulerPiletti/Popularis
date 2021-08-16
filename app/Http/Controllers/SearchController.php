<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminPautasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index($keywords, Request $request)
    {
        $page_config = ['Aqui estão alguns reultados', 'Caso não tenha encontrado o que buscava, tente utilizar outras palavras-chave.'];
        
        if (null === $request->session()->get('pagination')) {
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
            $pautas_to_show = DB::table('pautas')->whereIn('id', $pautas_founded_id)->take(5)->get();

            return Inertia::render('public/Busca', ['db_data' => [$pautas_to_show], 'total_pautas' => $total_pautas, 'page_config' => $page_config]);
        } else {
            $pagination = $request->session()->get('pagination');
            $pautas_to_show = $pagination[0];
            $total_pautas = $pagination[1];

            return Inertia::render('public/Busca', ['db_data' => [$pautas_to_show], 'total_pautas' => $total_pautas, 'page_config' => $page_config]);
        }
    }
}
