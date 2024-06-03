<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => Hash::make('test1234'),
            'profile_photo_path' => 'profile_photos/user.jpg',
        ]);

        for ($i = 1; $i <= 9; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'role_id' => 2,
                'password' => Hash::make('test1234'),
                'profile_photo_path' => 'profile_photos/user.jpg',
            ]);
        }
    }
}
