<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GiftCard;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GiftCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            GiftCard::create([
                'code' => 'IGRA-' . Str::random(10),
                'value' => rand(10, 100),
                'is_redeemed' => false,
                'user_id' => $userIds[array_rand($userIds)],
            ]);
        }
    }
}
