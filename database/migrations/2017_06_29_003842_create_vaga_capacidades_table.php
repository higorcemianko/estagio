<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagaCapacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga_capacidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vaga')->unsigned();
            $table->integer('id_capacidade')->unsigned();
            $table->foreign('id_vaga')->references('id')->on('vagas');
            $table->foreign('id_capacidade')->references('id')->on('capacidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaga_capacidades');
    }
}
