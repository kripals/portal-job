<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsJobLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_locations', function (Blueprint $table) {
            $table->bigInteger('job_country_id')->unsigned()->index()->nullable()->after('id');
            $table->foreign('job_country_id')->references('id')->on('job_countries')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_locations', function (Blueprint $table) {
            $table->dropForeign('job_country_id');
        });
    }
}
