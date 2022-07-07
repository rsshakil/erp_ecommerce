<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_controls', function (Blueprint $table) {
            $table->increments('image_control_id')->comment('image_control id');  
            $table->enum('type', [ '1','2','3'])->default('1')->comment('1product2bannner3right_image');
            $table->unsignedInteger("product_id")->index();
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('image', 250)->comment('image')->nullable();
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
        Schema::table('image_controls', function(Blueprint $table)
        {
            $table->dropForeign('image_controls_product_id_foreign'); 
        });
        Schema::dropIfExists('image_controls');
    }
}
