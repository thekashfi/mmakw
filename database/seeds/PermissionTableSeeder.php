<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
		//
		$permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
		   'menu-list',
           'menu-create',
           'menu-edit',
           'menu-delete',
		   'user-list',
           'user-create',
           'user-edit',
           'user-delete'
        ];


        foreach ($permissions as $permission) {
             Permission::create(['guard_name'=>'admin','name' => $permission]);
        }
    }
}
