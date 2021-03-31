<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesurveyquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spe_survey_questions', function (Blueprint $table) {
            $table->id();
            $table->string('survey_question',200);
            $table->integer('question_number');
            $table->string('question_type');
            $table->foreignId('spe_survey_id')->constrained();
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
        Schema::dropIfExists('spesurveyquestions');
    }
}
