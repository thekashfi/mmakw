<?php
  
use Illuminate\Database\Seeder;
use App\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		
		
		$user = Admin::create([
		    'userType' => 'admin',
        	'name'     => 'Administrator', 
        	'email'    => 'imtiaz@gulfclick.net',
			'mobile'   => '67099240',
			'image'    => '',
			'roles'    => '',
			'username' => 'admin',
        	'password' => bcrypt('12345678'),
			'is_active'=> '1',
        ]);
  
        $role = Role::create(['name' => 'Admin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}