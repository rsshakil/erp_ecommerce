<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->increments('contact_detail_id')->comment('contact_id id'); 
            $table->unsignedInteger("contact_id")->index();
            $table->foreign('contact_id')->references('contact_id')->on('contacts'); 
           $table->string('title', 350)->comment('full_name')->nullable();
           $table->string('full_name', 350)->comment('full_name')->nullable();
           $table->string('address1', 350)->comment('address1')->nullable();
            $table->string('address2', 350)->comment('address2')->nullable();
            $table->string('city', 350)->comment('address2')->nullable();
            $table->string('country', 350)->comment('address2')->nullable();
            $table->string('phone', 350)->comment('address2')->nullable();
            $table->string('mobile', 350)->comment('address2')->nullable();
            $table->string('email', 350)->comment('address2')->nullable(); 
            $table->enum('type', ['warehouse','contact_person'])->default('contact_person')->comment('employee type');
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
        Schema::dropIfExists('contact_details');
    }
}
