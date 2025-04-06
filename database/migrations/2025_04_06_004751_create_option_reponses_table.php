<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionReponsesTable extends Migration
{
    public function up()
    {
        Schema::create('option_reponses', function (Blueprint $table) {
            $table->id('id_option');
            $table->text('intitule_option');
            $table->unsignedBigInteger('id_question');
            $table->foreign('id_question')->references('id_question')->on('questions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('option_reponses');
    }
}
