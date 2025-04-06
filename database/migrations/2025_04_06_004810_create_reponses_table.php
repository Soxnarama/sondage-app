<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponsesTable extends Migration
{
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->id('id_reponse');
            $table->unsignedBigInteger('id_question');
            $table->unsignedBigInteger('id_user');
            $table->text('intitule_reponse');
            $table->foreign('id_question')->references('id_question')->on('questions')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reponses');
    }
}
