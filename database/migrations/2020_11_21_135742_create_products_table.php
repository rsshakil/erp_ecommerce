<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id')->comment('product id');
            
            $table->unsignedInteger("client_id")->index();
            $table->foreign('client_id')->references('id')->on('users');

            // $table->unsignedInteger("merchant_shop_id")->index();
            // $table->foreign('merchant_shop_id')->references('branch_control_id')->on('branch_controls');

            $table->unsignedInteger("contact_id")->index();
            $table->foreign('contact_id')->references('contact_id')->on('contacts');

			$table->string('product_code', 30)->comment('p code')->nullable();
			$table->string('barcode', 36)->comment('barcode')->nullable();
            $table->string('product_name', 80)->comment('p name')->nullable();
            $table->string('unit', 50)->comment('unit')->nullable();
            $table->longText('product_description')->comment('product_description')->nullable();
            $table->string('warrranty', 150)->comment('warrranty')->nullable();
            
            $table->string('p_color', 150)->comment('color')->nullable();
            $table->string('p_size', 150)->comment('size')->nullable();
            $table->string('p_diemension', 150)->comment('diemension')->nullable();
            $table->string('p_weight', 150)->comment('weight')->nullable();
            $table->integer('p_quantity')->default('0')->comment('qty_left');
            $table->integer('p_qty_left')->default('0')->comment('qty_left');
            $table->double('p_price',15,2)->default('0')->comment(' price');
            $table->double('p_cost_price',15,2)->default('0')->comment('cost price');
            $table->double('p_wholesale_price',15,2)->default('0')->comment('wholesale price');
            $table->double('p_avg_price',15,2)->default('0')->comment(' price');



            $table->text('product_includes')->comment('product_includes')->nullable();
            $table->string('protfolio', 150)->comment('protfolio')->nullable();
            $table->enum('product_type', ['Retail', 'FnB','Service','Raw','Asset','Stationery'])->default('Retail')->comment('product type');

            $table->unsignedInteger("category_id")->index();
            $table->foreign('category_id')->references('product_categorie_id')->on('product_categories');

            // $table->unsignedInteger("sub_category_id")->index();
            // $table->foreign('sub_category_id')->references('product_categorie_id')->on('product_categories');
            // $table->unsignedInteger("brand_id")->index();
            // $table->foreign('brand_id')->references('type_control_id')->on('type_controls');
            // $table->unsignedInteger("manufacturer_id")->index();
            // $table->foreign('manufacturer_id')->references('type_control_id')->on('type_controls');

           
            $table->integer('min_qty')->nullable()->comment('min_qty');
            
            $table->double('discount',15,2)->default('0')->comment(' discount');
            $table->string('tax_group',50)->comment(' tax_group')->nullable();
            $table->enum('status', ['0', '1'])->default('0')->comment('0 single,1 multiple');
            $table->enum('publish_status', ['0', '1'])->default('0')->comment('publish status');
            $table->enum('display_status', ['0','1', '2','3'])->default('0')->comment('display type');
            $table->string('prodcut_image', 240)->comment('Image of product')->nullable();
            $table->text('instruction_list')->comment('instruction_list')->nullable();
            $table->text('review_list')->comment('review_list')->nullable();
            $table->text('support_list')->comment('support_list')->nullable();
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
        Schema::table('products', function(Blueprint $table)
        {
            $table->dropForeign('products_client_id_foreign'); 
            $table->dropForeign('products_contact_id_foreign'); 
            // $table->dropForeign('products_merchant_shop_id_foreign'); 
            $table->dropForeign('products_category_id_foreign'); 
            // $table->dropForeign('products_sub_category_id_foreign'); 
            // $table->dropForeign('products_brand_id_foreign'); 
            // $table->dropForeign('products_manufacturer_id_foreign'); 
        });
        Schema::dropIfExists('products');
    }
}
