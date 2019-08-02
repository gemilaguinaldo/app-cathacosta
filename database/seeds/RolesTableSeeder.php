<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $roles = [
        	[
        		'name' => 'Administrator',
          		'display_name' => 'Admin',
          		'description' => 'The one who manages the application.',
        	],
        	[
        		'name' => 'User',
          		'display_name' => 'User',
          		'description' => 'User of application that tracks the expenses.',
        	],
        ];

        Role::truncate();
        foreach ($roles as $key => $value) {
            Role::create($value);
        }

      // $role_user = [
	    // 	[
	    // 		'1',
	    // 		'1',
	    // 	],
	    // 	[
	    // 		'2',
	    // 		'2',
	    // 	],
	    // ];

     //  DB::table('role_user')->truncate();
	    // foreach ($role_user as $ru ) {
	    //     DB::table('role_user')
	    //       ->insert([
	    //         'user_id' => $ru[0],
	    //         'role_id' => $ru[1]
	    //       ]);
	    // }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
