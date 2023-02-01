<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobJobSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_job_skill', function (Blueprint $table) {
            $table->bigInteger('job_id')->unsigned();
            $table->bigInteger('job_skill_id')->unsigned();

            $table->foreign('job_id')->references('id')->on('jobs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_skill_id')->references('id')->on('job_skills')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['job_id', 'job_skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_job_skill');
    }
}
