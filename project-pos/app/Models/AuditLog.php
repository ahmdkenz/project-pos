<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'actor',
        'type',
        'action',
        'message',
        'ip_address',
        'user_agent',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get icon berdasarkan type
     */
    public function getIconAttribute(): string
    {
        return match($this->type) {
            'sales' => 'shopping-cart',
            'product' => 'package',
            'stock' => 'database',
            'security' => 'user-check',
            'danger' => 'alert-triangle',
            default => 'activity',
        };
    }

    /**
     * Get icon color berdasarkan type
     */
    public function getIconColorAttribute(): string
    {
        return match($this->type) {
            'sales' => '#0284C7',
            'product' => '#4F46E5',
            'stock' => '#D97706',
            'security' => '#0E9F6E',
            'danger' => '#DC2626',
            default => '#718096',
        };
    }

    /**
     * Get background color berdasarkan type
     */
    public function getColorAttribute(): string
    {
        return match($this->type) {
            'sales' => '#E0F2FE',
            'product' => '#eef2ff',
            'stock' => '#FEF3C7',
            'security' => '#DEF7EC',
            'danger' => '#FEE2E2',
            default => '#F3F4F6',
        };
    }

    /**
     * Scope untuk filter berdasarkan tipe
     */
    public function scopeOfType($query, $type)
    {
        if ($type) {
            return $query->where('type', $type);
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
}
