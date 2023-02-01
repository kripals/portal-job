<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderFieldsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->bigInteger('order')->unsigned()->index()->nullable()->after('is_deleted');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->bigInteger('order')->unsigned()->index()->nullable()->after('is_deleted');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->bigInteger('order')->unsigned()->index()->nullable()->after('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
