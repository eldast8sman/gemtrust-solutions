<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner',
        'description',
        'bank',
        'bank_code',
        'bank_nip',
        'account_number',
        'account_name'
    ];
}
