<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'admin', 
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123456789')
        ]);
  
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'User']);
   
        // $permissions = Permission::pluck('id','id')->all();
  
        // $role->syncPermissions($permissions);
   
        $user->assignRole([$roleAdmin->id]);
    }
}
