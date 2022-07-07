<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\contact\contact_detail;
class Contact_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array([
            'contact_id'=>1,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'contact_person'
        ],
        [
            'contact_id'=>1,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'contact_person'
        ],
        [
            'contact_id'=>1,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'warehouse'
        ],
        [
            'contact_id'=>1,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'warehouse'
        ],
        [
            'contact_id'=>2,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'contact_person'
        ],
        [
            'contact_id'=>2,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'contact_person'
        ],
        [
            'contact_id'=>2,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'warehouse'
        ],
        [
            'contact_id'=>2,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'type'=>'warehouse'
        ]
        );
        //contact_detail::insert($array);
    }
}
