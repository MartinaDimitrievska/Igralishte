<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $sizeIds = Size::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            ProductSize::create([
                'product_id' => $productIds[$i],
                'size_id' => $sizeIds[$i],
            ]);
        }
    }
}
