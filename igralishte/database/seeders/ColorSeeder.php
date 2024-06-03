<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $colors = [
            'red', 'orange', 'yellow', 'green', 'blue', 'pink', 'purple', 'gray', 'white', 'black'
        ];

        foreach ($colors as $color) {
            Color::create(['name' => $color]);
        }
    }
}
