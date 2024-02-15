<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = ['Cine', 'Música', 'Teatro', 'Magia', 'Festival', 'Gaming', 'Deporte', 'Exhibición', 'Humor', 'Danza'];
        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }
    }
}
