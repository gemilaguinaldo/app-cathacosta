<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');

	        $users = [
	        	// admin
	        	[
		        	'firstname' => 'Admin',
		        	'lastname' => 'Sample',
		        	'email' => 'admin@sample.com',
		        	'password' => bcrypt('pass1234'),
		            'role_id' => 1
	        	],
	        	// user
	        	[
		        	'firstname' => 'User',
		        	'lastname' => 'Sample',
		        	'email' => 'user@sample.com',
		        	'password' => bcrypt('pass1234'),
		            'role_id' => 2,
		        ]
	        ];

	        User::truncate();
	        foreach ($users as $key => $value) {
	            User::create($value);
	        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
