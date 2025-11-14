Berikut adalah 8 tabel utama yang Anda butuhkan, sesuai skema Anda:

1. users

Tujuan: Menyimpan data login Admin (hanya 1 role).

Kolom Kunci: id, name, email, password.

2. products

Tujuan: Data master semua barang/produk.

Kolom Kunci: id, name (Nama Barang), sku (Kode Barang), sale_price (Harga Jual), current_stock (Stok Saat Ini), min_stock_level (Batas Stok untuk Notifikasi).

3. purchase_lots (Sangat Penting untuk Profit)

Tujuan: Melacak harga modal (harga beli) per batch pembelian untuk perhitungan FIFO (First-In, First-Out).

Kolom Kunci: id, product_id, quantity_received (Jumlah Beli), quantity_remaining (Sisa Batch), cost_price_per_unit (Harga Modal per item).

4. stock_movements (Inti Inventaris)

Tujuan: "Buku Besar" yang mencatat setiap pergerakan stok (masuk, keluar, retur, rusak).

Kolom Kunci: id, product_id, quantity (Bisa +100 atau -2), reason (tipe pergerakan: sale, stock_in, adjustment).

5. sales

Tujuan: "Header" struk. Satu baris per satu transaksi penjualan.

Kolom Kunci: id, user_id (Admin yang menjual), total_amount (Total Uang Struk), payment_method.

6. sale_items

Tujuan: "Detail" struk. Item-item apa saja yang ada di dalam satu transaksi sales.

Kolom Kunci: id, sale_id (link ke sales), product_id, quantity (jumlah terjual), price_per_unit (salinan harga jual), cost_price_per_unit (salinan harga modal dari purchase_lots).

7. sync_operations (Kunci PWA Offline)

Tujuan: Mencegah data ganda (idempotency). Mencatat UUID unik dari setiap operasi offline yang dikirim PWA.

Kolom Kunci: id, client_operation_uuid (Kunci unik dari browser), status (pending, success), payload (JSON data).

8. notification_records

Tujuan: Mencatat notifikasi yang sudah dikirim (misal: "Stok Kopi Habis") agar tidak mengirim spam.

Kolom Kunci: id, product_id, type (low_stock), sent_at.
