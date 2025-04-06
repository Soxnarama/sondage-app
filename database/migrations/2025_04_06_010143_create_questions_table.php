<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id('id_question');
            $table->unsignedBigInteger('id_sondage');
            $table->text('intitule_question');
            $table->boolean('obligatoire')->default(false);
            $table->enum('typeQuestion', ['choix_unique', 'choix_multiple', 'texte', 'nombre']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_ques_predefinie')->nullable();
            $table->foreign('id_sondage')->references('id_sondage')->on('sondages')->onDelete('cascade');
            $table->foreign('id_ques_predefinie')->references('id_ques_predefinie')->on('question_predefinie')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
