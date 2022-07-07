<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\User;
use App\users_details;
use App\product\type_control;
class Type_controlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_control_list=array(
            [
                'client_id' => '5',
                'type' => '1',
                'name' =>'Samusung',
                'entry_by' =>'5'
            ],[
                'client_id' => '5',
                'type' => '1',
                'name' =>'Toyota',
                'entry_by' =>'5'
            ], [
                'client_id' => '5',
                'type' => '2',
                'name' =>'Brand-1',
                'entry_by' =>'5'
            ],[
                'client_id' => '5',
                'type' => '2',
                'name' =>'Brand-2',
                'entry_by' =>'5'
            ]
            );
           // type_control::insert($type_control_list);
    }
}
