<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complain extends Model
{
    use HasFactory;
    protected $fillable = [
         'hall_name', 'user_id','user_name',"complain"
    ];
}
