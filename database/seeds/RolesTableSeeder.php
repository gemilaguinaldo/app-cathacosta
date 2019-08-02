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

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
