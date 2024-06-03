<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;
use App\Models\DiscountCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Spring Sale',
            'Summer Sale',
            'Winter Sale',
            'Autumn Sale',
            'Valentines Day',
            'Easter',
            'New Year is ON',
        ];

        foreach ($categories as $category) {
            DiscountCategory::create([
                'name' => $category,
            ]);
        }
    }
}
