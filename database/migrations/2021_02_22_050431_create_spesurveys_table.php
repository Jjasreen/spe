<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesurveys', function (Blueprint $table) {
            $table->id();
            $table->string('survey_title',200);
            $table->string('unit_code',100);
            $table->string('teaching_period',200);
            $table->timestamp('survey_upload_date');
            $table->string('survey_question',300);
            $table->foreignId('upload_id')->constrained();
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
        Schema::dropIfExists('spesurveys');
    }
}
