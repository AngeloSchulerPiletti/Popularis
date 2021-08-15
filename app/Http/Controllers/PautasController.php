<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PautasController extends Controller
{
    public function index()
    {
        return Inertia::render('public/Entenda');
    }

    const PAUTAS_TYPE    = ['atuais', 'passadas', 'futuras'];
    const PAUTAS_SECTION = ['estadual', 'federal'];

    public function show_section($section)
    {
        if (!in_array($section, self::PAUTAS_SECTION)) {
            abort(404);
        }
        $escope_title = $section == "federal" ? "Federais" : "Estaduais";


        $db_data = [];
        for ($i = 1; $i <= 3; $i++) {
            $db_data[] = $section == "federal" ? DB::table('pautas')
                ->where('escopo', $section)
                ->where('status', $i)
                ->take(6)
                ->get()
                : DB::table('pautas')
                ->where('escopo', $section)
                ->where('status', $i)
                ->where('local', Auth::user()->uf)
                ->take(6)
                ->get();
        }


        foreach ($db_data as $dataArr) {
            if (count($dataArr) > 0) {
                foreach ($dataArr as $dataObj) {
                    $dataObj->autores    = explode('-', $dataObj->autores);
                    $dataObj->final_date = explode('-', $dataObj->final_date);
                    $dataObj->final_date = implode('/', $dataObj->final_date);
                }
            }
        }

        $escope = [$section];
        $page_config = ["Essas são as pautas " . $escope_title, [["Pautas passadas: ", "Aqui você pode ver as pautas que já foram votadas e seus resultados"], ["Pautas em votação: ", "Aproveite para votar enquanto estão disponíveis"], ["Pautas futuras: ", "Leia um pouco sobre as pautas que aguardam aprovação técnica"]]];

        return Inertia::render('public/Pautas/Pautas', ['db_data' => $db_data, 'escope' => $escope, 'page_config' => $page_config, 'escope_url' => $section]);
    }
    public function show_section_type($section, $type, Request $request)
    {
        $escope = [$section, $type];
        $escope_title = $section == "federal" ? "Federais" : "Estaduais";
        $page_config = ["Essas são as pautas " . $escope_title, "Caro cidadão, procure sempre se informar antes de qualquer decisão. Aja com responsabilidade."];


        if (null === $request->session()->get('pagination')) {
            if ((!in_array($section, self::PAUTAS_SECTION) || (!in_array($type, self::PAUTAS_TYPE)))) {
                abort(404);
            }
            $status_arr = ['passadas' => 1, 'atuais' => 2, 'futuras' => 3];

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
                ->take(5)
                ->get()
                : DB::table('pautas')
                ->where('escopo', $section)
                ->where('status', $status_arr[$type])
                ->where('local', Auth::user()->uf)
                ->take(5)
                ->get();

            //$db_data: 1 array, pauta->local == auth->user->uf, pauta->status == $type(status);
            return Inertia::render('public/Pautas/Pautas', ['total_pautas' => $total_pautas, 'db_data' => [$db_data], 'escope' => $escope, 'page_config' => $page_config, 'escope_url' => $section]);
        } else {
            $pagination = $request->session()->get('pagination');
            $db_data = $pagination[0];
            $total_pautas = $pagination[1];

            return Inertia::render('public/Pautas/Pautas', ['total_pautas' => $total_pautas, 'db_data' => [$db_data], 'escope' => $escope, 'page_config' => $page_config, 'escope_url' => $section]);
        }
    }
}
