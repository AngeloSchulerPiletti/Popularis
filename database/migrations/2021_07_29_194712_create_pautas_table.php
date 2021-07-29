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
            $table->tinyText('autores'); 
            $table->string('escopo'); //Se Federal (BR), senão RS, RN, BH...
            $table->tinyText('palavras_chave')->nullable();
            $table->tinyInteger('assunto'); 
            $table->mediumText('resumo');
            $table->longText('pauta');
            /*+-------------------------------+
              |      CONTAGEM DE VOTOS        |
              +-------------------------------+*/
            $table->tinyInteger('neg_votes')->default(0);
            $table->tinyInteger('pos_votes')->default(0);
            //STATUS DA VOTAÇÃO
            $table->integer('status')->default(4); // 1-perdeu 2-venceu 3-em votação 4-futura

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
