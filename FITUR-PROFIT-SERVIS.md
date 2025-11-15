# 📊 Fitur Laporan Profit & Manajemen Servis

## 🎯 Overview

Sistem ini mencakup 2 fitur utama:

1. **Laporan Profit** - Analisis keuntungan kotor (Gross Profit) dari penjualan
2. **Manajemen Servis** - Sistem tracking servis/perbaikan perangkat pelanggan

---

## 📈 LAPORAN PROFIT

### Fitur Utama

- **Gross Profit Calculation**: Total Penjualan (Gross) - COGS (Cost of Goods Sold)
- **KPI Widgets**: Total Penjualan, COGS, Gross Profit, Margin
- **Filter**: Rentang tanggal, produk, kategori
- **Detail Tabel**: Breakdown per transaksi penjualan

### File Terkait

```
app/Http/Controllers/ReportController.php
resources/views/reports/profit.blade.php
```

### Route

```php
Route::get('/reports/profit', [ReportController::class, 'profit'])->name('reports.profit');
```

### Perhitungan Profit

```php
// Total Penjualan (Gross)
$totalSales = SaleItem::sum(price_per_unit * quantity)

// COGS (Cost of Goods Sold)
$totalCOGS = SaleItem::sum(cost_price_per_unit * quantity)

// Gross Profit
$grossProfit = $totalSales - $totalCOGS

// Profit Margin
$profitMargin = ($grossProfit / $totalSales) * 100
```

### Filter yang Tersedia

- **Rentang Tanggal**: `start_date` dan `end_date`
- **Produk**: `product_id`
- **Kategori**: `category`

### Cara Menggunakan

1. Akses menu **Laporan Profit** di sidebar
2. Pilih filter yang diinginkan (opsional)
3. Klik **Filter Laporan**
4. Lihat KPI widgets dan detail tabel

---

## 🔧 MANAJEMEN SERVIS

### Fitur Utama

- **CRUD Lengkap**: Create, Read, Update, Delete
- **Status Workflow**: Pending → Progress → Done → Picked-up
- **Auto Service Code**: Format `SVC-001`, `SVC-002`, dst
- **Filter Status**: Tab untuk masing-masing status
- **Search**: Cari berdasarkan nama pelanggan/device
- **Pagination**: 25 data per halaman
- **Audit Log**: Otomatis log setiap CRUD action

### File Terkait

```
database/migrations/2025_11_14_120000_create_services_table.php
app/Models/Service.php
app/Http/Controllers/ServiceController.php
resources/views/services/index.blade.php
resources/views/services/create.blade.php
resources/views/services/edit.blade.php
database/seeders/ServiceSeeder.php
```

### Routes

```php
Route::resource('services', ServiceController::class);

// Generate routes:
// services.index   → GET    /services
// services.create  → GET    /services/create
// services.store   → POST   /services
// services.edit    → GET    /services/{id}/edit
// services.update  → PUT    /services/{id}
// services.destroy → DELETE /services/{id}
```

### Status Workflow

```
┌─────────┐     ┌──────────┐     ┌──────┐     ┌───────────┐
│ Pending │────▶│ Progress │────▶│ Done │────▶│ Picked-up │
└─────────┘     └──────────┘     └──────┘     └───────────┘
  Kuning         Ungu            Hijau         Abu-abu
```

| Status      | Label                | Warna             | Timestamp      |
| ----------- | -------------------- | ----------------- | -------------- |
| `pending`   | Menunggu Cek         | Kuning (#F59E0B)  | -              |
| `progress`  | Dalam Pengerjaan     | Ungu (#8B5CF6)    | -              |
| `done`      | Selesai (Siap Ambil) | Hijau (#10B981)   | `completed_at` |
| `picked-up` | Sudah Diambil        | Abu-abu (#6B7280) | `picked_up_at` |

### Database Schema

```sql
CREATE TABLE services (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    service_code VARCHAR(50) UNIQUE NOT NULL,      -- SVC-001, SVC-002
    customer_name VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NULLABLE,
    device_type VARCHAR(100) NOT NULL,             -- Laptop, PC, Monitor, Printer
    device_brand VARCHAR(255) NULLABLE,
    complaint TEXT NOT NULL,
    diagnosis TEXT NULLABLE,
    action_taken TEXT NULLABLE,
    status ENUM('pending', 'progress', 'done', 'picked-up') DEFAULT 'pending',
    cost DECIMAL(10,2) DEFAULT 0,
    completed_at TIMESTAMP NULLABLE,
    picked_up_at TIMESTAMP NULLABLE,
    created_by BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);
```

### Model Features

#### Auto Service Code Generation

```php
// Automatically generates SVC-001, SVC-002, etc
Service::generateServiceCode();
```

#### Status Label Accessor

```php
$service->status_label;
// Returns: "Menunggu Cek", "Dalam Pengerjaan", etc
```

#### Status Badge Accessor

```php
$service->status_badge;
// Returns HTML badge with appropriate color
```

#### Scopes

```php
// Filter by status
Service::byStatus('pending')->get();

// Search by customer name or device
Service::search('Ahmad')->get();

// Chain scopes
Service::byStatus('done')->search('Laptop')->paginate(25);
```

### Controller Logic

#### Store (Create)

```php
1. Validate input
2. Generate service_code automatically
3. Create service record
4. Log to audit_logs (type: 'service', action: 'created')
5. Redirect with success message
```

#### Update

```php
1. Validate input
2. Detect status change:
   - If status → 'done': Set completed_at = now()
   - If status → 'picked-up': Set picked_up_at = now()
3. Update service record
4. Log to audit_logs (action: 'updated')
5. Redirect with success message
```

#### Delete

```php
1. Delete service record
2. Log to audit_logs (action: 'deleted')
3. Redirect with success message
```

### Form Fields

#### Create Form

- ✅ `customer_name` (required)
- `customer_phone` (optional)
- ✅ `device_type` (required, select: Laptop/PC/Monitor/Printer/Lainnya)
- `device_brand` (optional)
- ✅ `complaint` (required, textarea)
- `cost` (optional, number, default: 0)
- ✅ `status` (required, select: pending/progress/done/picked-up)

#### Edit Form (Additional Fields)

- All create form fields, plus:
- `diagnosis` (textarea)
- `action_taken` (textarea)

### Filter & Search

#### Filter by Status (Tabs)

```php
// In index view
<a href="{{ route('services.index') }}">Semua</a>
<a href="{{ route('services.index', ['status' => 'pending']) }}">Pending</a>
<a href="{{ route('services.index', ['status' => 'progress']) }}">Progress</a>
<a href="{{ route('services.index', ['status' => 'done']) }}">Done</a>
<a href="{{ route('services.index', ['status' => 'picked-up']) }}">Picked-up</a>
```

#### Search

```php
// Search by customer name or device
Service::search($request->search)->paginate(25);
```

### Validasi

#### Store Validation

```php
'customer_name' => 'required|string|max:255',
'customer_phone' => 'nullable|string|max:20',
'device_type' => 'required|string|max:100',
'device_brand' => 'nullable|string|max:255',
'complaint' => 'required|string',
'diagnosis' => 'nullable|string',
'action_taken' => 'nullable|string',
'status' => 'required|in:pending,progress,done,picked-up',
'cost' => 'nullable|numeric|min:0',
```

#### Update Validation

Same as store validation (all fields editable)

---

## 🚀 Quick Start

### 1. Run Migrations

```bash
php artisan migrate
```

### 2. Seed Sample Data

```bash
# Seed services (5 dummy records)
php artisan db:seed --class=ServiceSeeder
```

### 3. Access Features

- **Laporan Profit**: Sidebar → Laporan Profit
- **Manajemen Servis**: Sidebar → Manajemen Servis

---

## 🔍 Testing

### Test Laporan Profit

1. Pastikan ada data `sales` dan `sale_items` di database
2. Akses `/reports/profit`
3. Coba filter berdasarkan tanggal
4. Verifikasi perhitungan:
   - Total Penjualan = sum(price_per_unit \* quantity)
   - COGS = sum(cost_price_per_unit \* quantity)
   - Gross Profit = Total Penjualan - COGS
   - Margin = (Gross Profit / Total Penjualan) \* 100

### Test Manajemen Servis

1. **List**: Akses `/services` → Lihat daftar servis
2. **Create**: Klik "Tambah Servis" → Isi form → Submit
3. **Edit**: Klik icon edit → Update data → Submit
4. **Delete**: Klik tombol hapus → Confirm
5. **Filter**: Klik tab status (Pending/Progress/Done/Picked-up)
6. **Search**: Gunakan search box untuk cari customer/device
7. **Audit Log**: Cek `/audit-log` → Verifikasi semua action tercatat

---

## 📋 Audit Log Integration

Semua action di Manajemen Servis otomatis tercatat di Audit Log:

| Action | Type      | Description                     |
| ------ | --------- | ------------------------------- |
| Create | `service` | "Menambah servis baru: SVC-XXX" |
| Update | `service` | "Mengupdate servis: SVC-XXX"    |
| Delete | `service` | "Menghapus servis: SVC-XXX"     |

### Logged Metadata

```json
{
  "service_code": "SVC-001",
  "customer_name": "Ahmad Yusuf",
  "status": "pending",
  "cost": 450000
}
```

---

## 🎨 Design Notes

### Profit Report

- **Layout**: KPI widgets di atas, tabel detail di bawah
- **Colors**:
  - Total Sales: Blue gradient (#3B82F6)
  - COGS: Orange gradient (#F59E0B)
  - Gross Profit: Green gradient (#10B981)
  - Margin: Purple gradient (#8B5CF6)
- **Icons**: Feather Icons (trending-up, dollar-sign, percent)

### Services Management

- **List**: Modern table dengan status badges
- **Create/Edit**: 2-column grid layout
- **Filter Tabs**: Active tab dengan gradient background
- **Buttons**: Primary (blue), Secondary (gray), Danger (red)

---

## ⚙️ Configuration

### Pagination

Default: 25 items per page

```php
// Change in ServiceController.php
Service::paginate(50); // Set to 50
```

### Service Code Format

Default: `SVC-001`, `SVC-002`

```php
// Change in Service model
return 'SRV-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
```

### Device Types

Defined in form select:

- Laptop
- PC
- Monitor
- Printer
- Lainnya

---

## 📊 Sample Data (ServiceSeeder)

- **SVC-001**: Ahmad Yusuf - Laptop Asus (Done)
- **SVC-002**: Siti Nurhaliza - PC Rakitan (Progress)
- **SVC-003**: Bambang Setiawan - Printer Canon (Pending)
- **SVC-004**: Dewi Lestari - Laptop HP (Picked-up)
- **SVC-005**: Eko Prasetyo - Monitor LG (Done)

---

## 🔐 Security

- **User Isolation**: `created_by` field tracks who created the service
- **CSRF Protection**: All forms include `@csrf` token
- **Method Spoofing**: Delete uses `@method('DELETE')`
- **Validation**: Server-side validation on all inputs
- **SQL Injection**: Protected by Eloquent ORM

---

## 📝 TODO / Future Enhancements

### Laporan Profit

- [ ] Export to Excel/PDF
- [ ] Chart/grafik profit trend
- [ ] Filter by product category
- [ ] Comparison with previous period

### Manajemen Servis

- [ ] Notifikasi WA otomatis saat status berubah
- [ ] Print service receipt/invoice
- [ ] Attach photos (before/after)
- [ ] Spare parts tracking
- [ ] Technician assignment
- [ ] Service warranty tracking

---

## 🆘 Troubleshooting

### Error: Service code already exists

**Solusi**: Service code unique constraint. Database mungkin corrupt. Reset seeder atau manual update `service_code`.

### Error: Class 'Service' not found

**Solusi**: Run `composer dump-autoload`

### Audit log tidak tercatat

**Solusi**: Pastikan `LogsActivity` trait sudah di-import di ServiceController

### Status timestamp tidak update

**Solusi**: Cek logic di `ServiceController@update` untuk deteksi perubahan status

---

**Dibuat**: 2025-11-14  
**Author**: System Development Team  
**Version**: 1.0.0
