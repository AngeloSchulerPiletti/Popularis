<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePautasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pautas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->string('url');
            $table->tinyInteger('responsavel');
            $table->tinyText('autores'); 
            $table->string('escopo'); //estadual || federal
            $table->string('local');  //Se Federal (BR), senão RS, RN, BH...
            $table->tinyText('palavras_chave');
            $table->string('assunto'); 
            $table->mediumText('resumo');
            $table->longText('pauta');
            /*+-------------------------------+
              |      CONTAGEM DE VOTOS        |
              +-------------------------------+*/
            $table->tinyInteger('neg_votes')->default(0);
            $table->tinyInteger('pos_votes')->default(0);
            //STATUS DA VOTAÇÃO
            $table->integer('status')->default(3); // 1-votação passada 2-em votação 3-precisa de aprovacao 4-deletado
            $table->integer('result')->default(0); // 0-Sem resultado 1- Perdeu 2- Venceu
            $table->string('final_date'); //ano-mes-dia  Ex: 13-12-2003
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pautas');
    }
}
