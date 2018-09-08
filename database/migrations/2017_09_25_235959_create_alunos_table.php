<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('ra');
            $table->date('dt_nasc');
            $table->string('nome');
            $table->integer('ddd');
            $table->integer('telefone');
            $table->integer('id_curso')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('alunos');
    }
}
