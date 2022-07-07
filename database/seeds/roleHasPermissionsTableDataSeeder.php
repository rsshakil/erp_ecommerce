<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class roleHasPermissionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = Role::findByName('Super Admin');
        $permissions = Permission::all();
        $role_super_admin->givePermissionTo($permissions);
        
        $role_admin = Role::findByName('Technical Admin');
        $role_admin->givePermissionTo('Technical_Admin_view');
        
        $role_admin = Role::findByName('Billing Admin');
        $role_admin->givePermissionTo('Billing_Admin_view');
        
        $role_admin = Role::findByName('Sales Admin');
        $role_admin->givePermissionTo('Sales_Admin_view');
        
        $role_admin = Role::findByName('Admin');
        $role_admin->givePermissionTo('Client_view','Company_view','Admin_view');
       
       
        $role_user = Role::findByName('Sales');
        $role_user->givePermissionTo('Sales_view');
       
        $role_user = Role::findByName('Accountant');
        $role_user->givePermissionTo('Accountant_view');
       
        $role_user = Role::findByName('Supplier');
        $role_user->givePermissionTo('Supplier_view');
       
        $role_user = Role::findByName('Customer');
        $role_user->givePermissionTo('Customer_view');
    }
}
