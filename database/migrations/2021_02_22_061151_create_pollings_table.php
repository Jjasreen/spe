<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollings', function (Blueprint $table) {
            $table->id();
            $table->string('unit_code');
            $table->string('teaching_period');
            $table->timestamp('polling_upload_date');
            $table->dateTime('polling_start_at');
            $table->dateTime('polling_end_at');
            $table->timestamp('polling_submit_date');
            $table->foreignId('upload_id')->constrained();
            $table->foreignId('unit_coordinator_id')->constrained();
            $table->foreignId('student_id')->constrained();
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
        Schema::dropIfExists('pollings');
    }
}
