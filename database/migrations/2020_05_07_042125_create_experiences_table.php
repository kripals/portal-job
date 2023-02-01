<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->bigInteger('candidate_id')->unsigned()->index()->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates')->onUpdate('cascade')->onDelete('cascade');
            $table->string('job_title');
            $table->string('company_name')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('location_id')->unsigned()->index()->nullable();
            $table->foreign('location_id')->references('id')->on('job_locations')->onUpdate('cascade');
            $table->bigInteger('company_category_id')->nullable()->unsigned()->index();
            $table->bigInteger('candidate_category_id')->nullable()->unsigned()->index();
            $table->foreign('company_category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->foreign('candidate_category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->bigInteger('job_level_id')->unsigned()->index();
            $table->foreign('job_level_id')->references('id')->on('job_levels')->onUpdate('cascade');
            $table->enum('is_current',['yes','no'])->nullable()->default('no');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
