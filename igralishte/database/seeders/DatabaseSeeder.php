<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProductCategorySeeder::class,
            StatusSeeder::class,
            BrandSeeder::class,
            BrandProductCategorySeeder::class,
            AccessorySeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            MaterialSeeder::class,
            DiscountCategorySeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            ProductDiscountSeeder::class,
            TagSeeder::class,
            FaqSeeder::class,
            OrderSeeder::class,
            ProductTagSeeder::class,
            ProductOrderSeeder::class,
            BrandTagSeeder::class,
            ProductMaterialSeeder::class,
            ProductSizeSeeder::class,
            ProductColorSeeder::class,
            GiftCardSeeder::class,
        ]);
    }
}
