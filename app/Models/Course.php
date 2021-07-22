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
        return $this->belongsTo(Semester::class);
    }
}