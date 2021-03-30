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
        //Schema::dropIfExists("conferencia");
        // Schema::create('conferencia', function (Blueprint $table) {
        //     $table->increments('Idconferencia');
        //     $table->integer('CodSala')->unsigned();
        //     $table->foreign('CodSala')->references('CodSala')->on('sala')->onDelete('cascade')->onUpdate('cascade');
        //     $table->string('Sala');
        //     $table->integer('CodSetor')->unsigned();
        //     $table->foreign('CodSetor')->references('CodSetor')->on('setor')->onDelete('cascade')->onUpdate('cascade');
        //     $table->string('NomeSetor');
        //     $table->datetime('Data');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
