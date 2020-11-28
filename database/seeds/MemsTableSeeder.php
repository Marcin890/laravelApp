<?php

use Illuminate\Database\Seeder;

class MemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 15; $i++)
        {

            DB::table('mems')->insert([


               'title' => $faker->word,
               'user_id' => $faker->numberBetween(1,10),
               'category_id' => $faker->numberBetween(1,5),
               'published' => $faker->boolean(50),
               
            ]);
        }
    }
}