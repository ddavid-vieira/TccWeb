<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conferencias extends Migration
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
            $table ->integer('CodSetor')->unsigned();
            $table->foreign('CodSetor')->references('CodSetor')->on('setor')->onDelete('Cascade')->onUpdate('Cascade');
            $table-> string('NomeSetor');
            $table->foreign('CodSala')->references('CodSala')->on('sala')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('Sala');
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
        Schema::dropIfExists("conferencia");
    }
}
