<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
            'letter_grade' => 'A+',
            'gpa' => '4.0'
        ]);
        Grade::create([
            'letter_grade' => 'A',
            'gpa' => '3.75'
        ]);
        Grade::create([
            'letter_grade' => 'A-',
            'gpa' => '3.5'
        ]);
        Grade::create([
            'letter_grade' => 'B',
            'gpa' => '3.25'
        ]);
        Grade::create([
            'letter_grade' => 'C+',
            'gpa' => '3.00'
        ]);
        Grade::create([
            'letter_grade' => 'C',
            'gpa' => '2.85'
        ]);
        Grade::create([
            'letter_grade' => 'D',
            'gpa' => '2.75'
        ]);
    }
}