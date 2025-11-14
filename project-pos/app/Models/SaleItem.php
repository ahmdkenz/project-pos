<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price_per_unit',
        'cost_price_per_unit',
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'cost_price_per_unit' => 'decimal:2',
        'quantity' => 'integer',
    ];
}
