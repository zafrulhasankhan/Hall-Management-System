<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class complain_register extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        "user_name","user_mail",'hall_name', 'dept_name', 'student_ID','roomno',"session"
    ];
}
