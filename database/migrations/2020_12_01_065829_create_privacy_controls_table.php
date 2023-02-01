<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivacyControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privacy_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_id')->nullable();
            $table->string('control_key')->nullable();
            $table->string('control_value')->nullable();
            $table->bigInteger('controlable_id')->nullable();
            $table->string("controlable_type")->nullable();
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
        Schema::dropIfExists('privacy_controls');
    }
}
