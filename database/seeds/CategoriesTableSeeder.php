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
        $categories = [
        	'Electric Bill',
        	'Water Bill',
        	'Grocery',
        ];

        foreach ($categories as $value) {
            Category::create([
            	'name' => $value,
            ]);
        }
    }
}
