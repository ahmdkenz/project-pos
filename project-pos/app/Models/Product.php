<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'current_stock',
        'cost_price',
        'sale_price',
        'min_stock_level',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->sku)) {
                $date = Carbon::now()->format('dmy'); // DDMMYY format
                $code = strtoupper(Str::random(6)); // 6-char alphanumeric uppercase
                $product->sku = "PRD-{$date}-{$code}";
            }
        });
    }
}
