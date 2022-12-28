<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    use HasFactory;

    protected $fillable = [
        'signal_provider_id',
        'signal_provider',
        'currency_pair',
        'order_type',
        'lot_size',
        'entry_price',
        'take_profit1',
        'take_profit2',
        'take_profit3',
        'stop_loss',
        'remarks'
    ];
}
