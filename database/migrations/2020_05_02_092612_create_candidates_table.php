<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ref_id')->unique();
            $table->bigInteger('job_level_id')->unsigned()->index()->nullable();
            $table->foreign('job_level_id')->references('id')->on('job_levels')->onUpdate('cascade')->onDelete('cascade');
            $table->string('experience_period')->nullable();
            $table->text('description')->nullable();
            $table->string('exp_salary_currency')->nullable();
            $table->enum('exp_salary_type',['above','equals','below'])->nullable()->default('equals');
            $table->string('exp_salary_amount')->nullable();
            $table->enum('exp_salary_rate',['hourly','daily','weekly','monthly','yearly'])->nullable()->default('monthly');
            $table->string('cur_salary_currency')->nullable();
            $table->enum('cur_salary_type',['above','equals','below'])->nullable()->default('equals');
            $table->string('cur_salary_amount')->nullable();
            $table->enum('cur_salary_rate',['hourly','daily','weekly','monthly','yearly'])->nullable()->default('monthly');
            $table->text('interest')->nullable();
            $table->string('specialization')->nullable();
            $table->string('current_address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('permanent_address')->nullable();
            $table->enum('travel_outside',['yes','no'])->nullable()->default('no');
            $table->enum('relocate_location',['yes','no'])->nullable()->default('no');
            $table->enum('two_wheeler_license',['yes','no'])->nullable()->default('no');
            $table->enum('four_wheeler_license',['yes','no'])->nullable()->default('no');
            $table->enum('two_wheeler_vehicle',['yes','no'])->nullable()->default('no');
            $table->enum('four_wheeler_vehicle',['yes','no'])->nullable()->default('no');
            $table->string('resume')->nullable();
            $table->string('keywords')->nullable();
            $table->bigInteger('views')->default(0)->nullable();
            $table->enum('status',['active','in_active'])->nullable()->default('in_active');
            $table->enum('visibility',['visible','invisible'])->nullable()->default('invisible');
            $table->enum('availability',['available','not_available'])->nullable()->default('not_available');
            $table->enum('is_verified',['yes','no'])->nullable()->default('no');
            $table->enum('is_deleted',['yes','no'])->nullable()->default('no');
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_deleted_by')->unsigned()->index()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_deleted_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('candidates');
    }
}
