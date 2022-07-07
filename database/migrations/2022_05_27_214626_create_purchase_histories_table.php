<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_histories', function (Blueprint $table) {
            $table->increments('purchases_history_id')->comment('purchases id');
            $table->unsignedInteger("purchases_id")->index();
            $table->foreign('purchases_id')->references('purchases_id')->on('purchases');
            $table->unsignedInteger("product_id")->index();
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('item_name', 300)->comment('sub_category_name')->nullable();
            $table->string('item_img', 300)->comment('sub_category_name')->nullable();
            $table->string('item_cat', 300)->comment('sub_category_name')->nullable();
            $table->integer('item_quantity')->default('0')->comment('item_quantity');
            $table->double('item_cost_price',15,2)->default('0')->comment(' item_cost_price');
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
        Schema::dropIfExists('purchase_histories');
    }
}
