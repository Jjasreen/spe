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
            $table->text('survey_answer_one');
            $table->text('survey_answer_two');
            $table->text('survey_answer_three');
            $table->text('survey_answer_four');
            $table->string('survey_answer_five');
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
