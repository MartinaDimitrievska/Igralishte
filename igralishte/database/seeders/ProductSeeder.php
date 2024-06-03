<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Status;
use App\Models\Product;
use App\Models\Accessory;
use Faker\Factory as Faker;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $statuses = Status::all();
        $categoryIds = ProductCategory::pluck('id')->toArray();
        $brandIds = Brand::pluck('id')->toArray();
        $accessoryIds = Accessory::pluck('id')->toArray();
        $colors = Color::all();
        $sizes = Size::all();

        $productNames = [
            'Pinc Partywear фустан',
            'Зелена кратка блуза',
            'Puffer кратка јакна',
            'Тексас шорцеви',
            'Панталони со висок струк',
            'Плетен џемпер',
            'Слоевитa мини-сукња',
            'Biker јакна',
            'Тексас фармерки',
            'Vintage vibes сако',
        ];

        foreach ($productNames as $productName) {
            $product = Product::create([
                'name' => $productName,
                'description' => 'Ова е vintage парче направено од материјал со текстура, се закопчува со патент.',
                'price' => $faker->numberBetween(500, 3000),
                'quantity' => $faker->numberBetween(1, 5),
                'size_advice' => 'Oва парче е направено од материјал кој не се растегнува. Одговара на наведената величина.',
                'product_category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'status_id' => $statuses->random()->id,
                'maintenance' => 'Се одржува според знаците на етикетата',
                'accessory_id' => $faker->randomElement($accessoryIds),
            ]);

            $imagePath = "product_images/{$product->id}.jpg";

            if (file_exists(public_path($imagePath))) {
                $product->images()->create(['image' => $imagePath]);
            }

            $colorIds = $colors->pluck('id')->shuffle()->unique()->take(rand(1, min(3, $colors->count())));
            $product->colors()->sync($colorIds);

            $sizeIds = $sizes->pluck('id')->shuffle()->unique()->take(rand(1, min(3, $sizes->count())));
            $product->sizes()->sync($sizeIds);
        }
    }
}
