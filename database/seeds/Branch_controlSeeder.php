<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\product\branch_control;

class Branch_controlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $branch_list =array([
            'client_id'=>5,
            'com_name'=>'Com-1',
            'br_name'=>'Branch-1',
            'wh_name'=>'Warehouse-1',
            'entry_by'=>5,
        ],[
            'client_id'=>5,
            'com_name'=>'Com-2',
            'br_name'=>'Branch-2',
            'wh_name'=>'Warehouse-2',
            'entry_by'=>5,
        ]);
       // branch_control::insert($branch_list);
    }
}
