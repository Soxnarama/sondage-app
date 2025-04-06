<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionPredefinieTable extends Migration
{public function up()
    {
        Schema::create('question_predefinie', function (Blueprint $table) {
            $table->id('id_ques_predefinie');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('question_predefinie');
    }
}