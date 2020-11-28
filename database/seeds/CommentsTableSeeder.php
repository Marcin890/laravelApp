<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        /* Lecture 10 */
        for ($i = 1; $i <= 50; $i++) {

            DB::table('comments')->insert([
                'content' => $faker->text(500),
                 'user_id' => $faker->numberBetween(1, 10),                 
                'mem_id' => $faker->numberBetween(1, 15),                 
            ]);
        }
    }
}