<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Status;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Pinc Partywear',
            'Factory Girl',
            'Main Days',
            'Fraeil',
            'Urma',
            'Cande Nest',
            'Beyond Green',
            'Gatta',
        ];

        $statuses = Status::all();

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'description' => 'Концептот на ' . $brand . ' базира на неколку прашања:Дали постои простор за етикетирања и та... ',
                'status_id' => $statuses->random()->id,
            ]);
        }
    }
}
