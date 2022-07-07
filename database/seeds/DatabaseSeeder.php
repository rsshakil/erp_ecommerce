<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(permissionsTableDataSeeder::class);
        $this->call(rolesTableDataSeeder::class);
        $this->call(roleHasPermissionsTableDataSeeder::class);
        $this->call(modelHasrolesTableDataSeeder::class);  
        
        
       // $this->call(ContactSeeder::class);
       // $this->call(Contact_detailSeeder::class);
        //$this->call(Type_controlSeeder::class);
        //$this->call(Branch_controlSeeder::class);
       // $this->call(Product_categorySeeder::class);
        //$this->call(ProductSeeder::class);
    }
}
