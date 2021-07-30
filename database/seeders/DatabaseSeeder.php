<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //Step-One
        $this->call([
            DepartmentsSeeder::class,
            GradesSeeder::class,
            ClassroomSeeder::class,
        ]);
        Semester::factory(8)->create();

        //step-2
        //Course::factory(10)->create();
        Teacher::factory(20)->create();
        Student::factory(30)->create();
        $this->call([
            // DepartmentsSeeder::class,
            // GradesSeeder::class,
            CoursesSeeder::class,
        ]);
    }
}