<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'reason',
        'related_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];
}
