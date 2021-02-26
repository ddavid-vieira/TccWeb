<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("conferencia", function (Blueprint $table) {
            $table->increments('Idconferencia');
            $table->integer('CodSala')->unsigned();
            $table->foreign('CodSala')->references('CodSala')->on('sala')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('Sala');
            $table->integer('Matricula')->unsigned();
            $table->foreign('Matricula')->references('Matricula')->on('servidor')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('Servidor');
            $table->string('Data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conferencia');
    }
}
