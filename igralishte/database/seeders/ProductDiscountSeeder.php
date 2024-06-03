<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Discount;
use App\Models\ProductDiscount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductDiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $discounts = Discount::all();

        foreach ($products as $product) {
            if (!$product->discounts()->exists()) {
                $discount = $discounts->random();
                $product->discounts()->attach($discount);
            }
        }
    }
}
