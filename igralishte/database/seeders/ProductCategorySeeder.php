<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Blouses',
            'Jeans',
            'Skirts/Shorts',
            'Dresses',
            'Jackets and Coats',
            'Underwear'
        ];

        foreach ($categories as $category) {
            ProductCategory::create(['name' => $category]);
        }
    }
}
