<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->increments('users_details_id')->comment('users_details_id');
            $table->unsignedInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
			$table->string('first_name', 80)->comment('first_name')->nullable();
            $table->string('last_name', 80)->comment('last_name')->nullable();
            $table->string('phone', 20)->comment('Phone Number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female','Others'])->default('Male')->comment('Gender of Users');
            $table->string('postal_code', 40)->comment('postal_code')->nullable();
            $table->char('country', 2)->nullable();
            $table->char('language', 2)->nullable();
            $table->string('currency', 10)->comment('currency')->default('৳')->comment('currency');
            $table->string('time_zone', 40)->comment('time_zone')->default('Asia/Dhaka');
            $table->string('citi_time_zone', 40)->comment('citime_zone')->nullable();
            $table->string('image', 240)->comment('Image of user')->nullable();
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
        Schema::table('users_details', function(Blueprint $table)
        {
            $table->dropForeign('users_details_user_id_foreign'); 
        });
        Schema::dropIfExists('users_details');
    }
}