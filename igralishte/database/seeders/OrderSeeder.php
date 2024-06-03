<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Discount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role_id', '<>', 1)->pluck('id')->toArray();

        $discountIds = Discount::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            Order::create([
                'user_id' => $userIds[array_rand($userIds)],
                'discount_id' => $discountIds[array_rand($discountIds)],
            ]);
        }
    }
}
