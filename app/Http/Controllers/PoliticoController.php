<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PoliticoController extends Controller
{
    protected const PATH = 'admin/politico/';

    /*+------------------------------------+
      |               SHOW                 |
      +------------------------------------+*/
    public function pauta_create_show()
    {
        return Inertia::render('admin/politico/CriadorPautas');
    }
    public function estatisticas_show(){
        return Inertia::render(self::PATH.'Estatisticas');
    }
    public function historico_pautas_show(){
        return Inertia::render(self::PATH.'HistoricoPautas');
    }
    public function gerenciar_equipe_show(){
        return Inertia::render(self::PATH.'GerenciadorEquipe');
    }
    //---------------- END --------------\\
}
