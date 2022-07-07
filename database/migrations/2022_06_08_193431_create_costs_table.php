<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->increments('cost_id')->comment('cost_id');
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->unsignedInteger("category_id")->index();
            $table->foreign('category_id')->references('cat_id')->on('categories');
            $table->string('cost_name', 150)->comment('category_name')->nullable();
            $table->string('sub_cost_name', 150)->comment('sub_category_name')->nullable();
            $table->double('cost_amount',15,2)->default('0')->comment('cost_amount');
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
        Schema::dropIfExists('costs');
    }
}
