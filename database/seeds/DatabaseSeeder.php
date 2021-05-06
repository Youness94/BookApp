<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB as DBS;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DBS::table('books')->insert([
                'title' => $faker->name,
                'description' => $faker->text(355)
            ]);
        }

        foreach (range(1, 10) as $index) {
            DBS::table('authors')->insert([
                'name' => $faker->name,
            ]);
        }
    }
}