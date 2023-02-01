<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateJobTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_job_type', function (Blueprint $table) {
            $table->bigInteger('candidate_id')->unsigned();
            $table->bigInteger('job_type_id')->unsigned();

            $table->foreign('candidate_id')->references('id')->on('candidates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_type_id')->references('id')->on('job_types')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['candidate_id', 'job_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_job_type');
    }
}
