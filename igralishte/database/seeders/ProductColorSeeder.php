<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $colorIds = Color::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            ProductColor::create([
                'product_id' => $productIds[$i],
                'color_id' => $colorIds[$i],
            ]);
        }
    }
}
