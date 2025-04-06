<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id('id_theme');
            $table->string('nom_theme', 100)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
