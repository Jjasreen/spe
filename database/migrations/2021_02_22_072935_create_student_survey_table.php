<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_survey', function (Blueprint $table) {
            $table->id();
            $table->string('student_answers');
            $table->date('date');
            $table->timestamp('time');
            $table->string('survey_url');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('spesurveyquestion_id')->constrained();
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
        Schema::dropIfExists('student_survey');
    }
}
