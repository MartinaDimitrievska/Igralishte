<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use App\Models\BrandProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandIds = Brand::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $categoryIds = ProductCategory::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            BrandProductCategory::create([
                'product_category_id' => $categoryIds[$i],
                'brand_id' => $brandIds[$i],
            ]);
        }
    }
}
