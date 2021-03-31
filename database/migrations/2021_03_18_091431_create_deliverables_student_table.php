<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverablesStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverables_student', function (Blueprint $table) {
            $table->id();
            $table->timestamp('end_date');
            $table->string('uuid');
            $table->foreignId('module_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('unit_coordinator_id')->constrained();
            $table->integer('completed');
            $table->integer('sent_by');
            $table->timestamp('submission_open_date');
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
        Schema::dropIfExists('deliverables_student');
    }
}
