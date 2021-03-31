<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpescoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spe_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('spe_total_scores');
            $table->tinyInteger('all_submitted');
            $table->integer('submit_count');
            $table->foreignId('team_id')->constrained();
            $table->foreignId('student_id')->constrained();
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
        Schema::dropIfExists('spescores');
    }
}
