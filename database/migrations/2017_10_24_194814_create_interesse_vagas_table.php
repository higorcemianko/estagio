<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteresseVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interesse_vagas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vaga')->unsigned();
            $table->foreign('id_vaga')->references('id')->on('vagas');
            $table->integer('id_aluno')->unsigned();
            $table->foreign('id_aluno')->references('id')->on('alunos');
            $table->integer('efetivado');

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
        Schema::dropIfExists('interesse_vagas');
    }
}
