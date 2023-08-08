<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sala extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sala", function (Blueprint $table) {
            $table->increments('CodSala');
            $table->integer("CodSetor")->unsigned();
            $table->foreign("CodSetor")->references("CodSetor")->on("setor")->onDelete('cascade')->onUpdate('cascade');
            $table->string('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("sala");
    }
}
