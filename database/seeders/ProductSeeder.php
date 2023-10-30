<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        $categories =  CategoryModel::where(['status' => true])->inRandomOrder()->get();

        foreach (range(1, 50) as $index) {
            ProductModel::create([
                'name' => $faker->name,
                'description' => $faker->sentence,
                'category_id' =>  $categories->random()->id,
                'created_at' => $faker->dateTime
            ]);
        }
    }
}
