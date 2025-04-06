<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelePersonnalisablesTable extends Migration
{
    public function up()
    {
        Schema::create('modele_personnalisables', function (Blueprint $table) {
            $table->id('id_model');
            $table->unsignedBigInteger('id_theme');
            $table->foreign('id_theme')->references('id_theme')->on('themes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modele_personnalisables');
    }
}
