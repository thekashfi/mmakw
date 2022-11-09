<?php
  
use Illuminate\Database\Seeder;
use App\Settings;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		Settings::create([
		    'keyname'  => 'setting',
        	'name_en'  => 'Gulfweb En', 
			'name_ar'  => 'Gulfweb Ar', 
        	'email'    => 'info@domain.com',
			'mobile'   => '66xxxxxx',
			'phone'    => '2265xxxx',
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
        ]);
  
        
    }
}