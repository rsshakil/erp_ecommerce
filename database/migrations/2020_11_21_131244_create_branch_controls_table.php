<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_controls', function (Blueprint $table) {
            $table->increments('branch_control_id')->comment('branch_control id');
            $table->unsignedInteger("client_id")->nullable();
            $table->foreign('client_id')->references('id')->on('users');
            $table->string('com_name', 150)->comment('name')->nullable();
            $table->string('br_name', 150)->comment('name')->nullable();
            $table->string('wh_name', 150)->comment('name')->nullable();
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
        Schema::table('branch_controls', function(Blueprint $table)
        {
            $table->dropForeign('branch_controls_client_id_foreign'); 
        });
        Schema::dropIfExists('branch_controls');
    }
}
