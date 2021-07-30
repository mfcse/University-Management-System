<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllocateClassroom extends Model
{
    use HasFactory;
    protected $guarded = [];

    // protected $appends = [
    //     'start_time_formatted',
    //     'end_time_formatted'
    // ];

    // public function getStartTimeFormattedAttribute()
    // {
    //     return date('H:i A', $this->start_time);
    // }
    // public function getEndTimeFormattedAttribute()
    // {
    //     return date('H:i A', $this->end_time);
    // }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code', 'code');
    }
}