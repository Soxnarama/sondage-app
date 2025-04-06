<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSondagesTable extends Migration
{
    public function up()
    {
        Schema::create('sondages', function (Blueprint $table) {
            $table->id('id_sondage');
            $table->unsignedBigInteger('id_user');
            $table->string('titre_sondage', 255);
            $table->string('logo', 255)->nullable();
            $table->enum('statut', ['brouillon', 'publié'])->default('brouillon');
            $table->string('url', 255)->unique();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sondages');
    }
}
