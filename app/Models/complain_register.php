<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complain_register extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_name","user_mail",'institute_name', 'dept_name', 'student_ID','roomno',"session","institute_id"
    ];
}
