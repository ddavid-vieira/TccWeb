<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Registerconferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registerconference', function (Blueprint $table) {
            $table->increments('IdRegisterConference');
            $table->integer('Idconferencia')->unsigned();
            $table->foreign('Idconferencia')->references('Idconferencia')->on('conferencia')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('Matricula')->unsigned();
            $table->foreign('Matricula')->references('Matricula')->on('servidor')->onDelete('cascade')->onUpdate('cascade');
            $table->datetime('DataInit');
            $table->datetime('DataClose')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registerconference');

    }
}
