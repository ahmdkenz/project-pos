<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Relasi ke Sale
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Relasi ke Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get subtotal untuk item ini
     */
    public function getSubtotalAttribute(): float
    {
        return $this->quantity * $this->price_per_unit;
    }

    /**
     * Get profit untuk item ini
     */
    public function getProfitAttribute(): float
    {
        return ($this->price_per_unit - $this->cost_price_per_unit) * $this->quantity;
    }
}
