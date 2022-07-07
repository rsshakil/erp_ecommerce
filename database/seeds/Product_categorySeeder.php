<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\product\product_category;

class Product_categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cat_list = array(
            [
            'client_id'=>5,
            'category_name'=>'Man',
            'sub_category_name'=>'Clothing',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Man',
            'sub_category_name'=>'Shoes',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Women',
            'sub_category_name'=>'Clothing',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Women',
            'sub_category_name'=>'Shoes',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Kids',
            'sub_category_name'=>'Clothing',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Kids',
            'sub_category_name'=>'Shoes',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Electronics',
            'sub_category_name'=>'Mobile',
            'entry_by'=>5
            ],
            [
            'client_id'=>5,
            'category_name'=>'Electronics',
            'sub_category_name'=>'Computer',
            'entry_by'=>5
            ]
        );
        //product_category::insert($cat_list);
    }
}
