<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function course_assigned()
    {
        return $this->hasOne(CourseAssign::class, 'course_code', 'code');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
    public function enrolls()
    {
        return $this->hasMany(StudentEnrollment::class, 'course_code', 'code');
    }
    public function allocate()
    {
        return $this->hasMany(AllocateClassroom::class, 'course_code', 'code');
    }
}