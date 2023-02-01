<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->unique();
            $table->bigInteger('company_id')->unsigned()->index()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('job_service_id')->unsigned()->index()->nullable();
            $table->foreign('job_service_id')->references('id')->on('job_services')->onUpdate('cascade');
            $table->bigInteger('vacancy_number')->nullable();
            $table->bigInteger('job_level_id')->unsigned()->index()->nullable();
            $table->foreign('job_level_id')->references('id')->on('job_levels')->onUpdate('cascade');
            $table->bigInteger('job_type_id')->unsigned()->index()->nullable();
            $table->foreign('job_type_id')->references('id')->on('job_types')->onUpdate('cascade');
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->string('location')->nullable();
            $table->string('min_salary_currency')->nullable();
            $table->enum('min_salary_type',['above','equals','below'])->nullable()->default('equals');
            $table->string('min_salary_amount')->nullable();
            $table->enum('min_salary_rate',['hourly','daily','weekly','monthly','yearly'])->nullable()->default('monthly');
            $table->string('max_salary_currency')->nullable();
            $table->enum('max_salary_type',['above','equals','below'])->nullable()->default('equals');
            $table->string('max_salary_amount')->nullable();
            $table->enum('max_salary_rate',['hourly','daily','weekly','monthly','yearly'])->nullable()->default('monthly');
            $table->enum('education_requirement',['yes','no'])->nullable()->default('no');
            $table->string('education_level')->nullable();
            $table->enum('experience_requirement',['yes','no'])->nullable()->default('no');
            $table->string('experience_type')->nullable();
            $table->string('experience_value')->nullable();
            $table->enum('skill_requirement',['yes','no'])->nullable()->default('no');
            $table->text('specification')->nullable();
            $table->text('description')->nullable();
            $table->enum('apply_online',['yes','no'])->nullable()->default('no');
            $table->enum('gender_specific',['yes','no'])->nullable()->default('no');
            $table->string('gender')->nullable();
            $table->enum('age_specific',['yes','no'])->nullable()->default('no');
            $table->string('age_type')->nullable();
            $table->string('age_value')->nullable();
            $table->enum('show_company',['yes','no'])->nullable()->default('no');
            $table->enum('is_verified',['yes','no'])->nullable()->default('no');
            $table->timestamp('end_date')->nullable();
            $table->enum('status',['active','in_active'])->nullable()->default('in_active');
            $table->enum('visibility',['visible','invisible'])->nullable()->default('invisible');
            $table->enum('availability',['available','not_available'])->nullable()->default('not_available');
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
        Schema::dropIfExists('jobs');
    }
}
