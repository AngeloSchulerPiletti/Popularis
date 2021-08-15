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

        $user_uf = Auth::user()->uf;
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
                ->where('local', $user_uf)
                ->take(6)
                ->get();
        }
        

        foreach ($db_data as $dataArr) {
            if(count($dataArr) > 0){
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
    public function show_section_type($section, $type)
    {
        if ((!in_array($section, self::PAUTAS_SECTION) || (!in_array($type, self::PAUTAS_TYPE)))) {
            abort(404);
        }
        $escope_title = $section == "federal" ? "Federais" : "Estaduais";
        $status_arr = ['passadas' => [1,2], 'atuais' => 3, 'futuras' => 4];
        


        //$db_data: 1 array, pauta->local == auth->user->uf, pauta->status == $type(status);

        

        $escope = [$section, $type];
        $page_config = ["Essas são as pautas " . $escope_title, "Caro cidadão, procure sempre se informar antes de qualquer decisão. Aja com responsabilidade."];
        
        return Inertia::render('public/Pautas/Pautas', ['db_data' => ["\$db_data"], 'escope' => $escope, 'page_config' => $page_config]);
    }
}
