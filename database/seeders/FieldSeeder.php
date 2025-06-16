<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            DB::table('fields')->insert([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'field_name' => 'Field Arena ' . $faker->word . ' ' . $index,
                'description' => $faker->sentence,
                'price_day' => $faker->numberBetween(120000, 150000),
                'price_night' => $faker->numberBetween(170000, 250000),
                'status' => $faker->randomElement(['available', 'unavailable']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
