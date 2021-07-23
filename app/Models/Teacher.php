<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function assined()
    {
        return $this->hasMany(CourseAssign::class, 'teacher_id', 'id');
    }
}