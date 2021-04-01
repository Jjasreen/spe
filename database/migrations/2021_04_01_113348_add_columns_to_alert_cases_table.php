<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAlertCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alert_cases', function (Blueprint $table) {
            //
            $table->text('survey_question');
            $table->integer('question_number');
            $table->text('answers');
            $table->foreignId('spe_survey_id')->constrained();
            $table->unsignedBigInteger('peer_id');
            $table->foreign('peer_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alert_cases', function (Blueprint $table) {
            //
        });
    }
}
