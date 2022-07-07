<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\User;
use App\users_details;
use App\product\product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demo_product=array(
            [
            'client_id'=>'5',
            'contact_id'=>'1',
            'merchant_shop_id'=>"1",
            'product_code'=>'Item-1-Red-xl',
            'barcode'=>'1234567891234',
            'product_name'=>'ITEM-1',
            'unit'=>'',
            'product_description'=>'test data',
            'warrranty'=>'2 years',
            'product_includes'=>'Charger,memory',
            'protfolio'=>'demo.txt',
            'category_id'=>'1',
            'sub_category_id'=>'1',
            'brand_id'=>'1',
            'manufacturer_id'=>'1',
            'min_qty'=>'2',
            'discount'=>'10',
            'tax_group'=>'Group-1',
            'publish_status'=>'1',
            'display_status'=>'1',
            'prodcut_image'=>'avater.png',
            'instruction_list'=>'Ins-1;ins-2;ins-3;',
            'review_list'=>'Review-1;Review-2;Review-3;',
            'support_list'=>'Support-1;Support-2;Support-3;',
            'entry_by'=>'5',
            'status'=>'1'
            ],
             [
                'client_id'=>'5',
                'contact_id'=>'1',
                'merchant_shop_id'=>"1",
                'product_code'=>'Item-1-Red-S',
                'barcode'=>'12345678912444',
                'product_name'=>'ITEM-1',
                'unit'=>'',
                'product_description'=>'test data',
                'warrranty'=>'2 years',
                'product_includes'=>'Charger,memory',
                'protfolio'=>'demo.txt',
                'category_id'=>'1',
                'sub_category_id'=>'1',
                'brand_id'=>'1',
                'manufacturer_id'=>'1',
                'min_qty'=>'2',
                'discount'=>'10',
                'tax_group'=>'Group-1',
                'publish_status'=>'1',
                'display_status'=>'1',
                'prodcut_image'=>'avater.png',
                'instruction_list'=>'Ins-1;ins-2;ins-3;',
                'review_list'=>'Review-1;Review-2;Review-3;',
                'support_list'=>'Support-1;Support-2;Support-3;',
                'entry_by'=>'5',
                'status'=>'1'
            ], [
                'client_id'=>'5',
                'contact_id'=>'1',
                'merchant_shop_id'=>"1",
                'product_code'=>'Item-1-BlK-XL',
                'barcode'=>'1234567891232',
                'product_name'=>'ITEM-1',
                'unit'=>'',
                'product_description'=>'test data',
                'warrranty'=>'2 years',  
                'product_includes'=>'Charger,memory',
                'protfolio'=>'demo.txt',
                'category_id'=>'1',
                'sub_category_id'=>'1',
                'brand_id'=>'1',
                'manufacturer_id'=>'1',
                'min_qty'=>'2',  
                'discount'=>'10',
                'tax_group'=>'Group-1',
                'publish_status'=>'1',
                'display_status'=>'1',
                'prodcut_image'=>'avater.png',
                'instruction_list'=>'Ins-1;ins-2;ins-3;',
                'review_list'=>'Review-1;Review-2;Review-3;',
                'support_list'=>'Support-1;Support-2;Support-3;',
                'entry_by'=>'5',
                'status'=>'1'
            ], [
                'client_id'=>'5',
                'contact_id'=>'1',
                'merchant_shop_id'=>"1",
                'product_code'=>'Item-2',
                'barcode'=>'1234567891234',
                'product_name'=>'ITEM-2',
                'unit'=>'',
                'product_description'=>'test data',
                'warrranty'=>'2 years',        
                'product_includes'=>'Charger,memory',
                'protfolio'=>'demo.txt',
                'category_id'=>'1',
                'sub_category_id'=>'1',
                'brand_id'=>'1',
                'manufacturer_id'=>'1',
                'min_qty'=>'2',
                'discount'=>'10',
                'tax_group'=>'Group-1',
                'publish_status'=>'1',
                'display_status'=>'1',
                'prodcut_image'=>'avater.png',
                'instruction_list'=>'Ins-1;ins-2;ins-3;',
                'review_list'=>'Review-1;Review-2;Review-3;',
                'support_list'=>'Support-1;Support-2;Support-3;',
                'entry_by'=>'5',
                'status'=>'0'
                ]
            );
           // product::insert($demo_product);
    }
}
