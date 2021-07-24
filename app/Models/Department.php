<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'department_id', 'id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function enroll()
    {
        return $this->hasMany(StudentEnrollment::class, 'department_id', 'id');
    }
}