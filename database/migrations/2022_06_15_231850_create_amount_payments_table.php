<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmountPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amount_payments', function (Blueprint $table) {
            $table->increments('amount_payments_id')->comment('amount_payments_id');
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->unsignedInteger("contact_id")->index();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');
            $table->string('bank_name', 150)->comment('category_name')->nullable();
            $table->string('checque_no', 150)->comment('sub_category_name')->nullable();
            $table->double('amount',15,2)->default('0')->comment('cost_amount');
            $table->enum('type', ['1', '2'])->default('1')->comment('1collection2payment');
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
        Schema::dropIfExists('amount_payments');
    }
}
