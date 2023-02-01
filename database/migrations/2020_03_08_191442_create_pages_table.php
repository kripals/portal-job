
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->integer('order')->nullable();
            $table->string('display_type')->nullable();
            $table->enum('is_active',array('yes','no'))->nullable()->default('no');
            $table->enum('is_sub_content',array('yes','no'))->nullable()->default('no');
            $table->integer('parent_page')->nullable();
            $table->string('meta_key')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_primary')->default(0);
            $table->enum('is_deleted',array('yes','no'))->nullable()->default('no');
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
        Schema::dropIfExists('pages');
    }
}
