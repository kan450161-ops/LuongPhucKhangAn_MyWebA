<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'fullname'   => fake()->name(),
                'username'   => fake()->unique()->userName(),
                'email'      => fake()->unique()->safeEmail(),
                'password'   => Hash::make('password123'),
                'phone'      => fake()->numerify('09########'),
                'address'    => fake()->streetAddress(),
                'gender'     => fake()->numberBetween(0, 2),
                'role'       => fake()->numberBetween(1, 2),
                'birthday'   => fake()->date(),
                'status'     => fake()->numberBetween(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}