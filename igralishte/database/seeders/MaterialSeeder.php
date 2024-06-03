<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            'polyester',
            'cotton',
            'linen',
            'denim',
            'silk',
            'wool',
            'satin',
        ];

        foreach ($materials as $material) {
            Material::create(['name' => $material]);
        }
    }
}