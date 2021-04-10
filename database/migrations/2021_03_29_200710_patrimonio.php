<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Patrimonio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists("patrimonio");
        // Schema::create("patrimonio", function (Blueprint $table) {
        //     $table->increments('CodPatrimonio');
        //     $table->integer('CodSala')->unsigned();
        //     $table->foreign('CodSala')->references('CodSala')->on('sala')->onDelete('cascade')->onUpdate('cascade');
        //     $table->string('Unidade Gestora');
        //     $table->string('Unidade');
        //     $table->string('DataTombamento');
        //     $table->string('DataGarantia');
        //     $table->string('Denominacao');
        //     $table->string('Marca');
        //     $table->string('Estado');
        //     $table->string('Finalidade');
        //     $table->string('Depreciavel');
        //     $table->string('Valor');
        //     $table->boolean('Alterou');
        //     $table->boolean('Verificado');
        //     $table->string('NovoEstado');
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
