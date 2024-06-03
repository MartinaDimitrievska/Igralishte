<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessories = ['Jewelry', 'Handbags'];

        foreach ($accessories as $accessory) {
            Accessory::create([
                'name' => $accessory,
            ]);
        }
    }
}
