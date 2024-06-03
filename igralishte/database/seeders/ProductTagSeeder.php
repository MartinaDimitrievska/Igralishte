<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $tagIds = Tag::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            ProductTag::create([
                'product_id' => $productIds[$i],
                'tag_id' => $tagIds[$i],
            ]);
        }
    }
}
