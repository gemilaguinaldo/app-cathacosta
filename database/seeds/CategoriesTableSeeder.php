<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $categories = [
        	'Electric Bill',
        	'Water Bill',
        	'Grocery',
        ];

        Category::truncate();
        foreach ($categories as $key => $value) {
            Category::create([
            	'name' => $value,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
