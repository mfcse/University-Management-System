<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'code' => 'CSE',
            'name' => 'Computer Science & Engineering'
        ]);
        Department::create([
            'code' => 'EEE',
            'name' => 'Electrical & Electronics Engineering'
        ]);
        Department::create([
            'code' => 'CS',
            'name' => 'Computer Science'
        ]);
        Department::create([
            'code' => 'CE',
            'name' => 'Civil Engineering'
        ]);
        Department::create([
            'code' => 'ME',
            'name' => 'Mechanical Engineering'
        ]);
        Department::create([
            'code' => 'BN',
            'name' => 'Bangla'
        ]);
        Department::create([
            'code' => 'EN',
            'name' => 'English'
        ]);
        Department::create([
            'code' => 'BIO',
            'name' => 'Biology'
        ]);
    }
}