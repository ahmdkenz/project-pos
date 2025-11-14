Tentu, berikut adalah alur kerja aplikasi dalam format Markdown.

---

## 2. ⚙️ Alur Kerja Aplikasi (Workflow)

Ini adalah bagaimana data mengalir melalui sistem Anda untuk setiap fitur.

### Alur 1: Barang Masuk (Menambah Stok)

1.  Admin membuka `/stock-in`.
2.  Laravel merender komponen Livewire `app/Livewire/StockIn/Create.php`.
3.  Admin mengisi form (Pilih Produk, Jumlah Masuk, Harga Beli/Modal).
4.  Admin klik "Simpan".
5.  Komponen `Create.php` memanggil `app/Services/InventoryService.php` dengan data tersebut.
6.  `InventoryService` melakukan 3 hal dalam satu **Transaksi Database**:
    - Membuat _batch_ baru di tabel `purchase_lots` (untuk mencatat harga modal/FIFO).
    - Mencatat pergerakan di `stock_movements` (misal: `product_id: 5, quantity: +100`).
    - Memperbarui `current_stock` di tabel `products` (misal: `stok += 100`).

### Alur 2: Penjualan (Kasir - Mode Online)

1.  Admin membuka `/pos`.
2.  Laravel merender komponen `app/Livewire/Sales/Pos.php`.
3.  Admin mengklik produk. Komponen `Pos.php` (via Livewire) menambahkan item ke properti `$cart` dan menghitung ulang total secara _real-time_ tanpa _refresh_ halaman.
4.  Admin klik "Proses Pembayaran".
5.  Komponen `Pos.php` memanggil `app/Services/InventoryService.php` (atau service penjualan terpisah).
6.  `InventoryService` melakukan 5 hal dalam satu **Transaksi Database**:
    - Membuat 1 baris di `sales` (header struk).
    - Membuat beberapa baris di `sale_items` (untuk setiap item di keranjang).
    - Menemukan harga modal/FIFO dari `purchase_lots` dan mengurangi `quantity_remaining` di sana.
    - Mencatat pergerakan di `stock_movements` (misal: `product_id: 5, quantity: -2`).
    - Memperbarui `current_stock` di tabel `products` (misal: `stok -= 2`).
7.  (Opsional) Sistem mengarahkan ke `PrintController.php` untuk mencetak struk.

### Alur 3: Penjualan (Kasir - Mode Offline PWA)

Ini adalah alur paling canggih.

1.  Koneksi internet terputus. `public/sw.js` (Service Worker) aktif.
2.  Admin membuka `/pos`. Service Worker menyajikan halaman dari _cache_ (mungkin `sales/offline-pos.blade.php`).
3.  Logika diambil alih oleh `resources/js/offline-sync.js`.
4.  Admin melakukan penjualan. Data (produk, keranjang) dibaca dan ditulis ke **IndexedDB** di browser.
5.  Saat penjualan diproses, `offline-sync.js` menyimpan data transaksi (lengkap dengan UUID unik) ke _queue_ di **IndexedDB**.
6.  Koneksi internet kembali tersambung.
7.  `offline-sync.js` mendeteksi koneksi dan mulai mengirim data dari _queue_ satu per satu ke `routes/api.php` (`Api/SyncController.php`).
8.  `SyncController` menerima data, membuat UUID unik di `sync_operations` (untuk mencegah data ganda), lalu memanggil `app/Services/SyncService.php` (atau `ProcessSyncQueueJob`).
9.  `SyncService` menjalankan **Alur 2 (Penjualan Online)** persis seperti di atas.
10. Server merespons "OK", dan `offline-sync.js` menghapus data dari _queue_ di IndexedDB.

### Alur 4: Laporan Keuangan (Profit)

1.  Admin membuka `/reports/profit`.
2.  Laravel merender `app/Livewire/Reports/Profit.php`.
3.  Admin memilih rentang tanggal.
4.  Komponen `Profit.php` mengambil data:
    - **Total Penjualan:** `SUM(total_amount)` dari tabel `sales` pada rentang tanggal itu.
    - **Total Modal (HPP):** `SUM(cost_price_per_unit * quantity)` dari tabel `sale_items` (yang datanya sudah disalin dari `purchase_lots` saat transaksi).
    - **Profit:** (Total Penjualan) - (Total Modal).
5.  Data dikirim ke _view_ dan ditampilkan.
