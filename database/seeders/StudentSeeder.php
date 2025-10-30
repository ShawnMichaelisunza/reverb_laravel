<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $genders = ['male', 'female'];
        $statuses = ['present', 'absent'];

        for ($i = 0; $i < 20; $i++) {
            Student::create([
                'name' => $faker->name,
                'section' => $faker->randomElement(['A', 'B', 'C', 'D']),
                'grade' => $faker->numberBetween(7, 12),
                'gender' => $faker->randomElement($genders),
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}
