<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\AuditLog;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            $today = Carbon::today();

            // 1. Total penjualan (nominal) hari ini
            $salesToday = Sale::whereDate('created_at', $today)->sum('total_amount') ?? 0;

            // 2. Jumlah transaksi hari ini
            $transactionsToday = Sale::whereDate('created_at', $today)->count() ?? 0;

            // 3. Count produk stok kritis (current_stock <= min_stock_level)
            $criticalStockCount = Product::whereColumn('current_stock', '<=', 'min_stock_level')
                ->where('min_stock_level', '>', 0)
                ->count() ?? 0;

            // 4. Ambil aktivitas terbaru (audit log) - 10 terakhir
            $activities = AuditLog::with('user')
                ->latest()
                ->limit(10)
                ->get();

        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            // Set default values jika terjadi error
            $salesToday = 0;
            $transactionsToday = 0;
            $criticalStockCount = 0;
            $activities = collect();
        }

        return view('dashboard', compact(
            'salesToday',
            'transactionsToday',
            'criticalStockCount',
            'activities'
        ));
    }
}
