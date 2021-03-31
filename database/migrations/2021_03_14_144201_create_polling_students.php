<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollingStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_students', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',255);
            $table->foreignId('student_id')->constrained();
            $table->foreignId('polling_id')->constrained();
            $table->foreignId('unit_coordinator_id')->constrained();
            $table->tinyInteger('completed');
            $table->tinyInteger('sent_by');
            $table->timestamp('end_date');
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
        Schema::dropIfExists('polling_students');
    }
}
