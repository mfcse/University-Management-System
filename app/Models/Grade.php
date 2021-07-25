<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    public function grade()
    {
        return $this->hasMany(Result::class, 'grade_id', 'id');
    }
}