<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'service_code',
        'customer_name',
        'customer_phone',
        'device_type',
        'device_brand',
        'complaint',
        'diagnosis',
        'action_taken',
        'status',
        'cost',
        'created_by',
        'completed_at',
        'picked_up_at',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'completed_at' => 'datetime',
        'picked_up_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User (yang membuat record)
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Cek',
            'progress' => 'Dalam Pengerjaan',
            'done' => 'Selesai (Siap Ambil)',
            'picked-up' => 'Sudah Diambil',
            default => 'Unknown',
        };
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status;
    }

    /**
     * Get device full name
     */
    public function getDeviceFullNameAttribute(): string
    {
        $brand = $this->device_brand ? $this->device_brand . ' ' : '';
        return $brand . $this->device_type;
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        if ($status && $status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('service_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('device_type', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Generate service code
     */
    public static function generateServiceCode(): string
    {
        $lastService = self::latest('id')->first();
        $number = $lastService ? $lastService->id + 1 : 1;
        return 'SVC-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
