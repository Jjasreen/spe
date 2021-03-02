<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverablesubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverablesubmissions', function (Blueprint $table) {
            $table->id();
            $table->string('submission_title');
            $table->dateTime('submission_open_date');
            $table->dateTime('submission_end_date');
            $table->timestamp('submission_upload_date');
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
        Schema::dropIfExists('deliverablesubmissions');
    }
}
