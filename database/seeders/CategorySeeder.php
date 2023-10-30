<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        foreach (range(1, 50) as $index) {
            DB::table('Category')->insert([
                'name' => $faker->name,
                'description' => $faker->sentence,
                'status' =>  $faker->boolean,
                'created_at' => $faker->dateTime
            ]);
        }
    }
}
