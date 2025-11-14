<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseLot extends Model
{
    protected $fillable = [
        'product_id',
        'quantity_received',
        'quantity_remaining',
        'cost_price_per_unit',
    ];

    protected $casts = [
        'quantity_received' => 'integer',
        'quantity_remaining' => 'integer',
        'cost_price_per_unit' => 'decimal:2',
    ];
}
