<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['possible_entry', 'name', 'code', 'nip'];

    public static function fetch_bankName($name){
        return self::where('name', $name)->orWhere('possible_entry', $name);
    }
}
