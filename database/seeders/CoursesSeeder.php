<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'code' => 'CSE-101',
            'name' => 'Algorithms',
            'credit' => 4.0,
            'description' => 'Algorithms',
            'department_id' => 1,
            'semester_id' => 1,
        ]);
        Course::create([
            'code' => 'CSE-102',
            'name' => 'Math',
            'credit' => 4.0,
            'description' => 'Math',
            'department_id' => 1,
            'semester_id' => 1,
        ]);
        Course::create([
            'code' => 'CSE-201',
            'name' => 'Data Structures',
            'credit' => 4.0,
            'description' => 'Structures',
            'department_id' => 1,
            'semester_id' => 2,
        ]);
        Course::create([
            'code' => 'CSE-105',
            'name' => 'Java',
            'credit' => 4.0,
            'description' => 'Java',
            'department_id' => 1,
            'semester_id' => 2,
        ]);
        Course::create([
            'code' => 'CSE-301',
            'name' => 'C#',
            'credit' => 4.0,
            'description' => 'C#',
            'department_id' => 1,
            'semester_id' => 2,
        ]);
    }
}