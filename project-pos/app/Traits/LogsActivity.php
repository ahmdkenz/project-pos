<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Log aktivitas ke audit log
     *
     * @param string $type (sales, product, stock, security, danger)
     * @param string $action (CREATE, UPDATE, DELETE, LOGIN, LOGOUT, etc)
     * @param string $message Detail aktivitas
     * @param array $metadata Data tambahan (optional)
     * @return AuditLog
     */
    protected function logActivity(
        string $type,
        string $action,
        string $message,
        array $metadata = []
    ): AuditLog {
        $user = Auth::user();

        return AuditLog::create([
            'user_id' => $user?->id,
            'actor' => $user?->name ?? 'System',
            'type' => $type,
            'action' => $action,
            'message' => $message,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'metadata' => !empty($metadata) ? $metadata : null,
        ]);
    }

    /**
     * Log login activity
     */
    protected function logLogin(string $userName): AuditLog
    {
        return $this->logActivity(
            'security',
            'LOGIN',
            'berhasil login ke sistem'
        );
    }

    /**
     * Log logout activity
     */
    protected function logLogout(string $userName): AuditLog
    {
        return $this->logActivity(
            'security',
            'LOGOUT',
            'keluar dari sistem'
        );
    }

    /**
     * Log product creation
     */
    protected function logProductCreated(string $productName, string $sku): AuditLog
    {
        return $this->logActivity(
            'product',
            'CREATE',
            "menambahkan produk baru <strong>{$productName} ({$sku})</strong>"
        );
    }

    /**
     * Log product update
     */
    protected function logProductUpdated(string $productName, string $sku): AuditLog
    {
        return $this->logActivity(
            'product',
            'UPDATE',
            "mengedit produk <strong>{$productName} ({$sku})</strong>"
        );
    }

    /**
     * Log product deletion
     */
    protected function logProductDeleted(string $productName, string $sku): AuditLog
    {
        return $this->logActivity(
            'danger',
            'DELETE',
            "menghapus produk <strong>{$productName} ({$sku})</strong>"
        );
    }

    /**
     * Log stock restock
     */
    protected function logStockRestock(string $productName, int $quantity): AuditLog
    {
        return $this->logActivity(
            'stock',
            'RESTOCK',
            "menambahkan stok untuk <strong>{$productName} ({$quantity} unit)</strong>"
        );
    }

    /**
     * Log sale creation
     */
    protected function logSaleCreated(string $invoiceNumber, float $totalAmount): AuditLog
    {
        return $this->logActivity(
            'sales',
            'CREATE',
            "memproses penjualan baru <strong>({$invoiceNumber})</strong> senilai Rp " . number_format($totalAmount, 0, ',', '.')
        );
    }
}
