<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $title = fake()->unique()->sentence(rand(3, 6));

            DB::table('posts')->insert([
                'title'      => $title,
                'slug'       => Str::slug($title),
                'content'    => fake()->paragraphs(5, true),
                'image'      => 'post-' . rand(1, 10) . '.jpg',
                'status'     => fake()->numberBetween(0, 1),
                'user_id'    => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}