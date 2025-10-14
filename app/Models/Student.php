<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'student_id',
        'name',
        'password',
        'course'
    ];
}
