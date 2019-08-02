<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $permissions = [
            [
                'name' => 'users',
                'module' => 'user_management',
            ],
            [
                'name' => 'roles',
                'module' => 'user_management',
            ],
            [
                'name' => 'expense-categories',
                'module' => 'expense_management',
            ],
            [
                'name' => 'expenses',
                'module' => 'expense_management',
            ],
        ];

        Permission::truncate();
        foreach ($permissions as $p) {
        	Permission::create($p);
        }

        $permission_role = [
        	[1, 1],
        	[2, 1],
        	[3, 1],
        	[4, 1],
        	[4, 2],
        ];
        DB::table('permission_role')->truncate();
        foreach ($permission_role as $pr) {
        	DB::table('permission_role')
        		->insert([
        			'permission_id' => $pr[0],
        			'role_id' => $pr[1]
        		]);
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
