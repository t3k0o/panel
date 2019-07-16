<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagBancomerPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_bancomer_personal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('etiqueta_id')->unsigned();
            $table->integer('personal_id')->unsigned();

            $table->foreign('etiqueta_id')->references('id')->on('etiqueta')->onDelete('cascade');
            $table->foreign('personal_id')->references('id')->on('bancomer_personal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_bancomer_personal');
    }
}
