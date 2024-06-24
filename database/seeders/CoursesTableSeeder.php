<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $courses = [
            'Introduction to Cryptocurrencies',
            'Blockchain Fundamentals',
            'Smart Contracts Development',
            'Cryptocurrency Trading and Investment',
            'Decentralized Finance (DeFi) Essentials',
        ];

        foreach ($courses as $courseName) {
            DB::table('courses')->insert([
                'name' => $courseName,
                'image' => $faker->imageUrl(640, 480, 'education', true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}