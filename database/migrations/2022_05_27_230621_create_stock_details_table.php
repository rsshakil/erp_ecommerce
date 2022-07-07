<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_details', function (Blueprint $table) {
            $table->increments('stock_detail_id')->comment('stock_detail_id id');
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->unsignedInteger("product_id")->index();
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->integer('stock_quantity')->default('0')->comment('stock_quantity');
            $table->double('purchase_price',15,2)->default('0')->comment(' price');
            $table->double('selling_price',15,2)->default('0')->comment(' price');
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
        Schema::dropIfExists('stock_details');
    }
}
