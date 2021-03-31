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
        Schema::create('spe_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('survey_title',200);
            $table->integer('spe_survey_numbder');
            $table->text('survey_description');
            $table->string('unit_code',100);
            $table->string('teaching_period',200);
            $table->timestamp('survey_upload_date');
            $table->foreignId('module_id')->constrained();
            $table->foreignId('unit_coordinator_id')->constrained();
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
