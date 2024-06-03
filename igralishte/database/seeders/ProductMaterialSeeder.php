<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Material;
use App\Models\ProductMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $materialIds = Material::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            ProductMaterial::create([
                'product_id' => $productIds[$i],
                'material_id' => $materialIds[$i],
            ]);
        }
    }
}
