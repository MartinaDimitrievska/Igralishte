<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $orderIds = Order::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            ProductOrder::create([
                'product_id' => $productIds[$i],
                'order_id' => $orderIds[$i],
            ]);
        }
    }
}
