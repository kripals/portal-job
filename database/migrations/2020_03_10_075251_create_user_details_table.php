<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('grand_father_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('nationality')->nullable();
            $table->string('citizenship_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('issue_place')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->enum('gender',['male','female','others'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'other'])->nullable();
            $table->string('contact_home')->nullable();
            $table->string('contact_office')->nullable();
            $table->string('personal_mobile_1')->nullable();
            $table->string('personal_mobile_2')->nullable();
            $table->string('permanent_house_no')->nullable();
            $table->string('permanent_tole')->nullable();
            $table->string('permanent_ward_no')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_country')->nullable();
            $table->string('permanent_mailing_address')->nullable();
            $table->string('temporary_house_no')->nullable();
            $table->string('temporary_tole')->nullable();
            $table->string('temporary_ward_no')->nullable();
            $table->string('temporary_city')->nullable();
            $table->string('temporary_district')->nullable();
            $table->string('temporary_state')->nullable();
            $table->string('temporary_country')->nullable();
            $table->string('temporary_mailing_address')->nullable();
            $table->string('website')->nullable();
            $table->string('fax')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('language')->nullable();
            $table->enum('is_deleted',['yes','no'])->nullable()->default('no');
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('last_updated_by')->nullable();
            $table->bigInteger('last_deleted_by')->nullable();
            $table->enum('status',['active','in_active'])->nullable()->default('in_active');
            $table->enum('availability',['available','not_available'])->nullable()->default('not_available');
            $table->timestamp('exit_date')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
