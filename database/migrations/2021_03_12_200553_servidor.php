<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servidor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //Schema::dropIfExists("servidor");
        Schema::create("servidor", function (Blueprint $table) {
            $table->increments('Matricula');
            $table->string('Nome');
            $table->string('Telefone');
            $table->string('Cpf');
            $table->string('Senha');
        });
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
