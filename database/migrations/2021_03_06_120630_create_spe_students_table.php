<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spe_students', function (Blueprint $table) {
            $table->id();
            $table->timestamp('end_date');
            $table->string('uuid');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('spe_survey_id')->constrained();
            $table->foreignId('unit_coordinator_id')->constrained();
            $table->integer('completed');
            $table->integer('sent_by');
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
        Schema::dropIfExists('spe_students');
    }
}
