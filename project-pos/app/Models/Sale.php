<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User (kasir yang melakukan transaksi)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke SaleItems (detail item yang dijual)
     */
    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Generate invoice number
     */
    public function getInvoiceNumberAttribute(): string
    {
        return 'INV/' . $this->created_at->format('Y/m') . '/' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get status (default: Lunas untuk semua transaksi)
     */
    public function getStatusAttribute(): string
    {
        return 'Lunas';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return 'success'; // Semua transaksi lunas
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        if ($userId) {
            return $query->where('user_id', $userId);
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeDateRange($query, $startDate = null, $endDate = null)
    {
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        return $query;
    }

    /**
     * Scope untuk search invoice
     */
    public function scopeSearchInvoice($query, $search)
    {
        if ($search) {
            // Search by ID atau created_at yang match dengan pattern invoice
            return $query->where(function($q) use ($search) {
                // Extract angka dari search
                $numbers = preg_replace('/[^0-9]/', '', $search);
                if ($numbers) {
                    $q->where('id', $numbers);
                }
            });
        }
        return $query;
    }
}
