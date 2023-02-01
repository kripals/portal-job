<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->bigInteger('views')->default(0)->after('is_verified');
            $table->string('company_name')->nullable()->after('location');
            $table->string('image')->nullable()->after('views');
            $table->text('apply_procedure')->nullable()->after('description');
            $table->string('source')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('views');
            $table->dropColumn('company_name');
            $table->dropColumn('image');
            $table->dropColumn('apply_procedure');
            $table->dropColumn('source');
        });

    }
}
