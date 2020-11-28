<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {

            DB::table('photos')->insert([
                'photoable_type' => 'App\User',
                'photoable_id' => $faker->unique()->numberBetween(1, 10),
                'path' => $faker->imageUrl(275, 150, 'people')
            ]);
        }

        for ($i = 1; $i <= 15; $i++) {

            DB::table('photos')->insert([
                'photoable_type' => 'App\Mem',
                'photoable_id' => $faker->numberBetween(1, 15),
                'path' => $faker->imageUrl(800, 400, 'nightlife')
            ]);
        }

    }
}