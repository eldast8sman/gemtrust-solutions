<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package',
        'description',
        'level',
        'reg_amount',
        'discount',
        'upline1',
        'upline2',
        'upline3',
        'upline4'
    ];
}
