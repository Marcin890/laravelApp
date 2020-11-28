<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 15; $i++) {

            DB::table('likes')->insert([
                 'user_id' => $faker->numberBetween(1, 10),
                 'mem_id' => $faker->numberBetween(1, 15),
            ]);
        }
    }
}