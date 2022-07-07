<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('cat_id')->comment('type_control id');
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer('parent_cat_id')->default('0')->comment('parent_cat_id');
            $table->string('cat_name', 150)->comment('category_name')->nullable();
            $table->string('sub_cat_name', 150)->comment('sub_category_name')->nullable();
            $table->string('cat_image', 150)->comment('cat_image')->nullable();
            $table->integer('types')->default('0')->comment('types');
            $table->enum('status', ['0', '1'])->default('1')->comment('1active');
            $table->integer('entry_by')->unsigned()->comment('entry_by');
			$table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Time of creation');
			$table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('Time of Update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
