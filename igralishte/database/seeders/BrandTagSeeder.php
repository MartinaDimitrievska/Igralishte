<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\BrandTag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandIds = Brand::inRandomOrder()->limit(5)->pluck('id')->toArray();

        $tagIds = Tag::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            BrandTag::create([
                'brand_id' => $brandIds[$i],
                'tag_id' => $tagIds[$i],
            ]);
        }
    }
}
