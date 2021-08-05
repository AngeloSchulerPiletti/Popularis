<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->string('cpf')->unique();
            $table->string('titulo_eleitoral')->unique();
            /*+---------------------------------+
              |        DADOS POLÍTICOS          |
              +---------------------------------+*/
            $table->boolean('politico')->default(false);
            $table->integer('politico_tipo')->nullable(); // 1-Dep. Est. | 2-Dep. Fed. | 3-Senador
            $table->string('uf'); // Estado (RS, RN, PB, BH, etc) 
            $table->tinyText('partido')->nullable(); // Partido Político
            /*+---------------------------------+
              |      HISTÓRICO DE VOTAÇÕES      |
              +---------------------------------+*/
            $table->tinyText('neg_votes')->nullable(); // Votações negativas passadas. Formatação: ID-ID-ID. Exemplo: 34-56-45-32
            $table->tinyText('pos_votes')->nullable(); // Votações positivas passadas.
            /*+---------------------------------+
              |        DADOS DO TÉCNICO         |
              +---------------------------------+*/
            $table->boolean('tecnico')->default(false);
            $table->integer('level')->default(0); // 1 -> apenas lê | 2-> lê e edita | 3->max
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
