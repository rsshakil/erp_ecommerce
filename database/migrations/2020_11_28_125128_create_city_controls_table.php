<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_controls', function (Blueprint $table) {
            $table->increments('city_control_id')->comment('city_control id');  
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer('charge')->default('0')->comment('charge');
            $table->string('city_name', 350)->comment('city_name')->nullable();
            $table->string('district', 350)->comment('district')->nullable();
            $table->string('country', 350)->comment('country')->nullable();
            $table->enum('status', ['0', '1'])->default('1')->comment('0inactive1active');
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
        Schema::table('city_controls', function(Blueprint $table)
        {
            $table->dropForeign('city_controls_client_id_foreign'); 
        });
        Schema::dropIfExists('city_controls');
    }
}
