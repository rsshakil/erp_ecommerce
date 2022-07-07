<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\users_details;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_array=array(
            [
                'name' => 'Super Admin',
                'email' => 'super_admin@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-0@gmail.com',
                'password' => bcrypt('123456')
            ],[
                'name' => 'Admin',
                'email' => 'Client-1@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-2@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-3@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-4@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-5@gmail.com',
                'password' => bcrypt('123456')
            ],[
                'name' => 'Admin',
                'email' => 'Client-6@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-7@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-8@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-9@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-10@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-11@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-12@gmail.com',
                'password' => bcrypt('123456')
            ],
           
            [
                'name' => 'Admin',
                'email' => 'Client-13@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-14@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-15@gmail.com',
                'password' => bcrypt('123456')
            ],[
                'name' => 'Admin',
                'email' => 'Client-16@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-17@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-18@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-19@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-20@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-21@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-22@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-23@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-24@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-25@gmail.com',
                'password' => bcrypt('123456')
            ],[
                'name' => 'Admin',
                'email' => 'Client-26@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-27@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-28@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-29@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-30@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-31@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-32@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-33@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-34@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'Client-35@gmail.com',
                'password' => bcrypt('123456')
            ]
        );

        
        $user_details_array=array(
            ['user_id'=>1],
            ['user_id'=>2],
            ['user_id'=>3],
            ['user_id'=>4],
            ['user_id'=>5],
            ['user_id'=>6],
            ['user_id'=>7],
            ['user_id'=>8],
            ['user_id'=>9],
            ['user_id'=>10],
            ['user_id'=>11],
            ['user_id'=>12],
            ['user_id'=>13],
            ['user_id'=>14],
            ['user_id'=>15],
            ['user_id'=>16],
            ['user_id'=>17],
            ['user_id'=>18],
            ['user_id'=>19],
            ['user_id'=>20],
            ['user_id'=>21],
            ['user_id'=>22],
            ['user_id'=>23],
            ['user_id'=>24],
            ['user_id'=>25],
            ['user_id'=>26],
            ['user_id'=>27],
            ['user_id'=>28],
            ['user_id'=>29],
            ['user_id'=>30],
            ['user_id'=>31],
            ['user_id'=>32],
            ['user_id'=>33],
            ['user_id'=>34],
            ['user_id'=>35],
            ['user_id'=>36],
            ['user_id'=>37]
        );
        User::insert($user_array);
        users_details::insert($user_details_array);
        
    }
}
