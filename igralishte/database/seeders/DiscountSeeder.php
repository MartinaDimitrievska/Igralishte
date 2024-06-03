<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\Discount;
use App\Models\DiscountCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $discountNames = [
            'Holiday discount',
            'Weekly deal',
            'First order offer',
            'Newsletter signup offer',
            'Product pre-launch offer',
        ];

        $statuses = Status::all();
        $discountCategories = DiscountCategory::all();

        foreach ($discountNames as $name) {
            Discount::create([
                'name' => $name,
                'discount' => $faker->randomElement(['10%', '20%', '30%', '40%', '50%']),
                'status_id' => $statuses->random()->id,
                'discount_category_id' => $discountCategories->random()->id,
            ]);
        }
    }
}
