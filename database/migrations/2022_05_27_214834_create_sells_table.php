<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->increments('sell_id')->comment('sell_id id');
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->unsignedInteger("contact_id")->index();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
			$table->string('invoice_no', 30)->comment('p code')->nullable();
            $table->integer('total_quantity')->default('0')->comment('min_qty');
            $table->double('total_amount',15,2)->default('0')->comment(' discount');
            $table->double('total_paid_amount',15,2)->default('0')->comment(' discount');
            $table->double('total_due_amount',15,2)->default('0')->comment(' discount');
            $table->double('total_discount_amount',15,2)->default('0')->comment(' discount');
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
        Schema::dropIfExists('sells');
    }
}
