<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlanceSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blance_sheets', function (Blueprint $table) {
            $table->increments('blance_sheet_id')->comment('blance_sheet id');
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer('total_amount')->default('0')->comment('stock_quantity');
            $table->integer('total_checque_amount')->default('0')->comment('stock_quantity');
            $table->integer('total_cash_amount')->default('0')->comment('stock_quantity');
            $table->integer('total_due_amount')->default('0')->comment('stock_quantity');
            $table->integer('total_paid_amount')->default('0')->comment('stock_quantity');
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
        Schema::dropIfExists('blance_sheets');
    }
}
