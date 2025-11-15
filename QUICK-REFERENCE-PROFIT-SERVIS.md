# ⚡ Quick Reference - Profit & Servis

## 📊 LAPORAN PROFIT

### Akses

```
Sidebar → Laporan Profit
URL: /reports/profit
```

### Filter

```php
// By date range
?start_date=2025-01-01&end_date=2025-12-31

// By product
?product_id=5

// By category
?category=Elektronik
```

### Perhitungan

```
Total Penjualan = Σ(price_per_unit × quantity)
COGS = Σ(cost_price_per_unit × quantity)
Gross Profit = Total Penjualan - COGS
Margin = (Gross Profit / Total Penjualan) × 100%
```

---

## 🔧 MANAJEMEN SERVIS

### Routes

```php
GET    /services              → index   (list)
GET    /services/create       → create  (form tambah)
POST   /services              → store   (simpan baru)
GET    /services/{id}/edit    → edit    (form edit)
PUT    /services/{id}         → update  (simpan edit)
DELETE /services/{id}         → destroy (hapus)
```

### Status Flow

```
pending → progress → done → picked-up
```

### Filter & Search

```php
// Filter by status
/services?status=pending
/services?status=progress
/services?status=done
/services?status=picked-up

// Search
/services?search=Ahmad
```

### Service Code

```php
// Auto-generated format
SVC-001, SVC-002, SVC-003, ...

// Manual generate
Service::generateServiceCode(); // Returns "SVC-XXX"
```

### Model Accessors

```php
$service->status_label;     // "Menunggu Cek"
$service->status_badge;     // HTML badge dengan warna
$service->service_code;     // "SVC-001"
```

### Scopes

```php
Service::byStatus('pending')->get();
Service::search('Ahmad')->get();
Service::byStatus('done')->search('Laptop')->paginate(25);
```

### Timestamps

```php
completed_at  → Set when status = 'done'
picked_up_at  → Set when status = 'picked-up'
```

### Validation Rules

```php
'customer_name'  => 'required|string|max:255',
'device_type'    => 'required|string|max:100',
'complaint'      => 'required|string',
'status'         => 'required|in:pending,progress,done,picked-up',
'cost'           => 'nullable|numeric|min:0',
```

### Device Types

- Laptop
- PC
- Monitor
- Printer
- Lainnya

### Audit Log

```php
// Auto-logged actions
- Create: "Menambah servis baru: SVC-XXX"
- Update: "Mengupdate servis: SVC-XXX"
- Delete: "Menghapus servis: SVC-XXX"
```

---

## 🎨 Status Colors

| Status    | Color  | Hex     |
| --------- | ------ | ------- |
| Pending   | Yellow | #F59E0B |
| Progress  | Purple | #8B5CF6 |
| Done      | Green  | #10B981 |
| Picked-up | Gray   | #6B7280 |

---

## 🔥 Common Tasks

### Create Service

```php
1. Klik "Tambah Servis"
2. Isi customer_name, device_type, complaint (wajib)
3. Pilih status (default: pending)
4. Submit
→ Service code auto-generated
→ Audit log tercatat
```

### Update Status

```php
1. Edit service
2. Ubah status:
   - pending → progress: Mulai pengerjaan
   - progress → done: Selesai → completed_at set
   - done → picked-up: Diambil → picked_up_at set
3. Submit
→ Timestamp otomatis update
→ Audit log tercatat
```

### Search Service

```php
// By customer name
Search: "Ahmad" → Find all services for Ahmad

// By device
Search: "Laptop" → Find all laptop services
```

### Filter Profit Report

```php
1. Pilih Start Date & End Date
2. (Optional) Pilih Product
3. Klik "Filter Laporan"
→ KPI widgets update
→ Detail table update
```

---

## 🛠️ Seeder Commands

```bash
# Seed services (5 dummy records)
php artisan db:seed --class=ServiceSeeder
```

---

## 📁 File Locations

### Laporan Profit

```
app/Http/Controllers/ReportController.php
resources/views/reports/profit.blade.php
```

### Manajemen Servis

```
database/migrations/2025_11_14_120000_create_services_table.php
app/Models/Service.php
app/Http/Controllers/ServiceController.php
resources/views/services/
  ├── index.blade.php
  ├── create.blade.php
  └── edit.blade.php
database/seeders/ServiceSeeder.php
```

---

## 🚨 Debug Checklist

### Profit tidak muncul

- [ ] Cek ada data di `sales` dan `sale_items`
- [ ] Pastikan `cost_price_per_unit` terisi di `sale_items`
- [ ] Cek filter tanggal sudah benar

### Service code error

- [ ] Run `composer dump-autoload`
- [ ] Cek unique constraint di database
- [ ] Reset seeder jika perlu

### Audit log kosong

- [ ] Cek `LogsActivity` trait di ServiceController
- [ ] Verifikasi method `logServiceCreated()` dipanggil
- [ ] Cek table `audit_logs` ada

### Status timestamp tidak update

- [ ] Cek logic di `ServiceController@update`
- [ ] Pastikan kondisi `$oldStatus !== $service->status`
- [ ] Debug dengan `dd($service->completed_at)`

---

**Last Updated**: 2025-11-14  
**Quick Reference v1.0**
