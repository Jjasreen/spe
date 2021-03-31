<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputeCaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispute_case_requests', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('module_id')->constrained();
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
        Schema::dropIfExists('dispute_case_requests');
    }
}
