<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Token_order extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'hall_name',
        'date',
        'name',
        'email',
        'phone',
        'amount',
        'breakfast',
        'lunch',
        'dinner',
        'status',
        'transaction_id',
        'currency'
        
    ];
}
