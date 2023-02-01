<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->bigInteger('candidate_id')->unsigned()->index()->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates')->onUpdate('cascade')->onDelete('cascade');
            $table->string('qualification_level')->nullable();
            $table->string('program_name')->nullable();
            $table->string('education_board')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('passing_year')->nullable();
            $table->string('marks_obtained')->nullable();
            $table->string('marks_type')->nullable();
            $table->enum('is_current',['yes','no'])->nullable()->default('no');
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
        Schema::dropIfExists('educations');
    }
}
