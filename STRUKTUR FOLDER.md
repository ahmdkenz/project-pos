toko-umkm/
├── app/
│ ├── Console/
│ │ └── Commands/
│ │ └── NotifyLowStock.php
│ ├── Http/
│ │ ├── Controllers/
│ │ │ ├── Auth/LoginController.php
│ │ │ ├── DashboardController.php
│ │ │ ├── Api/SyncController.php
│ │ │ └── PrintController.php
│ │ └── Livewire/
│ │ ├── Product/
│ │ │ ├── Index.php
│ │ │ └── Form.php
│ │ ├── StockIn/
│ │ │ └── Create.php
│ │ ├── Sales/
│ │ │ ├── Pos.php
│ │ │ ├── OfflinePos.php
│ │ │ └── History.php
│ │ └── Reports/
│ │ └── Profit.php
│ ├── Jobs/
│ │ └── ProcessSyncQueueJob.php
│ ├── Models/
│ │ ├── User.php
│ │ ├── Product.php
│ │ ├── StockMovement.php
│ │ ├── PurchaseLot.php
│ │ ├── Sale.php
│ │ ├── SaleItem.php
│ │ ├── SyncOperation.php
│ │ └── NotificationRecord.php
│ ├── Services/
│ │ ├── InventoryService.php
│ │ ├── SyncService.php
│ │ └── PrintService.php
│ └── ...
├── database/
│ └── migrations/
│ ├── ...\_create_users_table.php
│ ├── ...\_create_products_table.php
│ ├── ...\_create_purchase_lots_table.php
│ ├── ...\_create_stock_movements_table.php
│ ├── ...\_create_sales_table.php
│ ├── ...\_create_sale_items_table.php
│ ├── ...\_create_sync_operations_table.php
│ └── ...\_create_notification_records_table.php
├── resources/
│ ├── js/
│ │ ├── app.js
│ │ ├── offline-sync.js
│ │ └── pwa-register.js
│ └── views/
│ ├── layouts/app.blade.php
│ ├── dashboard.blade.php
│ ├── products/
│ ├── stock/
│ ├── sales/
│ │ ├── pos.blade.php
│ │ └── offline-pos.blade.php
│ ├── invoices/
│ └── reports/
├── routes/
│ ├── web.php
│ └── api.php
├── public/
│ └── sw.js
└── ...
