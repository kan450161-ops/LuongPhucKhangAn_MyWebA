<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {

            $name = fake()->unique()->word(2,true);   
            DB::table('brands')->insert([
                'brandname' => ucfirst($name),
                'slug' => Str::slug($name),
                'image' => fake()->imageUrl(),
                'status' => fake()->numberBetween(0,1),
                'sort_order' => $i,
                'description' => fake()->sentence(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
