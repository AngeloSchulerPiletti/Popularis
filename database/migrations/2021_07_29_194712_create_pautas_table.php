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
