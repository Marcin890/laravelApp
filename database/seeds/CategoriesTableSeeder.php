<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=1; $i < 8; $i++) { 
            DB::table('categories')->insert([
                'name'=>$faker->unique()->word
            ]);
        }
    }
}