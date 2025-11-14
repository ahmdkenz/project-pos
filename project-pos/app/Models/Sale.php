<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
}
