<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputecasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispute_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_title',100);
            $table->string('case_description',300);
            $table->dateTime('case_date');
            $table->string('case_status');
            $table->foreignId('student_id')->constrained();
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
        Schema::dropIfExists('disputecases');
    }
}
