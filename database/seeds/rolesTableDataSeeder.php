<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class rolesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_array=array(
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Technical Admin',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Billing Admin',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Sales Admin',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Sales',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Accountant',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Supplier',
                'guard_name' => 'web',
                'is_system' => 1,
            ],
            [
                'name' => 'Customer',
                'guard_name' => 'web',
                'is_system' => 1,
            ]
        );

        DB::table('roles')->insert($role_array);
    }
}
