<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['sedan', 'SUV', 'off-road', 'hatchback'];

        foreach ($categories as $category) {
            Categories::create([
                'name' => $category,
            ]);
        }
    }
}
