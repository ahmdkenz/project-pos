# Quick Reference - Audit Log System

## 🎯 URL Endpoints

| Halaman | URL | Route Name |
|---------|-----|------------|
| Dashboard | `/dashboard` | `dashboard` |
| Audit Log | `/audit-log` | `audit-log` |

---

## 💡 Contoh Penggunaan di Controller Baru

### Template Basic Controller dengan Logging:

```php
<?php

namespace App\Http\Controllers;

use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    use LogsActivity;

    public function store(Request $request)
    {
        // ... validasi & simpan data ...
        
        // Log aktivitas
        $this->logActivity(
            'type',      // sales, product, stock, security, danger
            'action',    // CREATE, UPDATE, DELETE, dll
            'message'    // Detail aktivitas (bisa pakai HTML tags)
        );
        
        return redirect()->back()->with('status', 'Berhasil!');
    }
}
```

---

## 🎨 Format Message untuk Consistency

Gunakan format yang konsisten dengan log yang sudah ada:

### Sales:
```php
"memproses penjualan baru <strong>(INV/2025/11/002)</strong> senilai Rp 150.000"
```

### Product:
```php
"menambahkan produk baru <strong>Nama Produk (SKU-001)</strong>"
"mengedit produk <strong>Nama Produk (SKU-001)</strong>"
"menghapus produk <strong>Nama Produk (SKU-001)</strong>"
```

### Stock:
```php
"menambahkan stok untuk <strong>Nama Produk (100 unit)</strong>"
```

### Security:
```php
"berhasil login ke sistem"
"keluar dari sistem"
```

---

## 📊 Query Audit Log Secara Manual

### Di Controller atau Tinker:

```php
use App\Models\AuditLog;

// Semua log hari ini
$today = AuditLog::whereDate('created_at', today())->get();

// Log penjualan saja
$sales = AuditLog::where('type', 'sales')->latest()->get();

// Log user tertentu
$userLogs = AuditLog::where('user_id', 1)->latest()->get();

// Log dalam range tanggal
$logs = AuditLog::whereBetween('created_at', [$start, $end])->get();

// Dengan filter custom
$filtered = AuditLog::ofType('product')
    ->dateRange('2025-11-01', '2025-11-30')
    ->get();
```

---

## 🔍 Debugging Tips

### Cek apakah logging berfungsi:

```bash
# Di Laravel Tinker
php artisan tinker

# Cek jumlah log
>>> App\Models\AuditLog::count()

# Cek log terakhir
>>> App\Models\AuditLog::latest()->first()

# Cek log per type
>>> App\Models\AuditLog::where('type', 'sales')->count()
```

### Jika log tidak muncul:
1. ✅ Pastikan `use LogsActivity;` trait sudah ditambahkan di controller
2. ✅ Pastikan method logging dipanggil setelah aksi berhasil
3. ✅ Cek apakah user sudah login (untuk auto actor name)
4. ✅ Cek migration sudah dijalankan: `php artisan migrate:status`

---

## 🎨 Customisasi Warna Badge

Edit di `resources/views/audit-log.blade.php`:

```css
.action-badge.custom {
    background-color: #F0E68C; /* Warna background */
    color: #8B4513;            /* Warna text */
}
```

Lalu gunakan:
```php
$this->logActivity('custom', 'ACTION', 'pesan...');
```

---

## 📱 Responsive Design

Halaman Audit Log sudah responsive dengan:
- `overflow-x: auto` pada tabel
- `min-width: 800px` pada table untuk prevent cramping
- Grid layout yang adapt di mobile

---

## 🚀 Performance Tips

### Untuk aplikasi dengan traffic tinggi:

1. **Auto Cleanup Old Logs**:
   ```php
   // Buat scheduled task di app/Console/Kernel.php
   $schedule->call(function () {
       AuditLog::where('created_at', '<', now()->subMonths(6))->delete();
   })->monthly();
   ```

2. **Index Database** (sudah ditambahkan):
   - Index pada `type` dan `created_at`
   - Index pada `user_id`

3. **Pagination** (sudah implemented):
   - Default 25 items per page

---

## 🔐 Best Practices

1. ✅ Jangan log sensitive data (password, token, dll)
2. ✅ Gunakan HTML tags (`<strong>`) hanya untuk highlight, jangan overuse
3. ✅ Message harus clear & descriptive
4. ✅ Gunakan metadata JSON untuk data structured tambahan
5. ✅ IP Address & User Agent otomatis tercatat, tidak perlu manual

---

## 📞 Support

Jika ada pertanyaan atau butuh tambahan fitur:
- Cek file: `FITUR-AUDIT-LOG.md` untuk dokumentasi lengkap
- Cek trait: `app/Traits/LogsActivity.php` untuk method yang tersedia
- Cek model: `app/Models/AuditLog.php` untuk attributes & relations

---

✨ Happy Logging! 🎉
