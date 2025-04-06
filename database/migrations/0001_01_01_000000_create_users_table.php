<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Assure-toi d'utiliser le bon type ici
            $table->string('last_name');
            $table->string('first_name');
            $table->string('mail')->unique();
            $table->string('password');
            $table->string('domaine')->nullable();
            $table->string('username')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
