<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::create([
            'code' => 'CSE-F1-101',
        ]);
        Classroom::create([
            'code' => 'CSE-F1-102',
        ]);
        Classroom::create([
            'code' => 'CSE-F1-103',
        ]);
        Classroom::create([
            'code' => 'CSE-F1-105',
        ]);
        Classroom::create([
            'code' => 'CSE-F1-104',
        ]);
    }
}