<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs_reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('reporter_name');
            $table->tinyInteger('reporter_id');
            $table->string('title');
            $table->tinyText('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bugs_reports');
    }
}
