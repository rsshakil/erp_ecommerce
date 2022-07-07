<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\contact\contact;
class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array([
            'client_id'=>5,
            'user_id'=>5,
            'title'=>'MR',
            'full_name'=>'Customer1',
            'contact_person_name'=>'contact 1',
            'contact_person_mobile'=>'234234234',
            'warehouse'=>'warehouse1',
            'credit_limit'=>'5000',
            'address1'=>'address 1',
            'address2'=>'address 2',
            'city'=>'city 1',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'total_sales'=>'59000',
            'total_payments'=>'666666',
            'installments'=>'6666',
            'balance'=>'60000',
            'type'=>'Customer'
        ],
        [
            'client_id'=>5,
            'user_id'=>5,
            'title'=>'MR',
            'full_name'=>'seller 1',
            'contact_person_name'=>'contact 2',
            'contact_person_mobile'=>'234234234',
            'warehouse'=>'warehouse2',
            'credit_limit'=>'5000',
            'address1'=>'address 2',
            'address2'=>'address 3',
            'city'=>'city 2',
            'country'=>'bangladesh',
            'phone'=>'3534534',
            'mobile'=>'5464564',
            'email'=>'email1@gmail.com',
            'total_sales'=>'59000',
            'total_payments'=>'666666',
            'installments'=>'6666',
            'balance'=>'60000',
            'type'=>'Vendor'
        ]
        );
       // contact::insert($array);
    }
}
