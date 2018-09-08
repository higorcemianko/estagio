<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagaAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vaga')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->foreign('id_vaga')->references('id')->on('vagas');
            $table->foreign('id_area')->references('id')->on('areas');
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
        Schema::dropIfExists('vaga_areas');
    }
}
