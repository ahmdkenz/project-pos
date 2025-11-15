<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;

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

            // 3. Count produk stok kritis (current_stock <= min_stock_level atau stok < 3)
            $criticalStockCount = Product::where(function($q) {
                    // Produk dengan min_stock_level yang sudah ditetapkan
                    $q->whereColumn('current_stock', '<=', 'min_stock_level')
                      ->where('min_stock_level', '>', 0);
                })
                ->orWhere(function($q) {
                    // Produk tanpa min_stock_level, anggap kritis jika stok < 3
                    $q->where(function($query) {
                        $query->whereNull('min_stock_level')
                              ->orWhere('min_stock_level', '=', 0);
                    })
                    ->where('current_stock', '<', 3)
                    ->where('current_stock', '>=', 0);
                })
                ->count() ?? 0;

            // 4. Ambil aktivitas terbaru (audit log) - 10 terakhir
            $activities = AuditLog::with('user')
                ->latest()
                ->limit(10)
                ->get();

            // 5. Pendapatan servis hari ini (gunakan completed_at atau picked_up_at)
            $start = Carbon::now()->startOfDay();
            $end = Carbon::now()->endOfDay();

            $serviceRevenueToday = (float) DB::table('services')
                ->whereIn('status', ['done', 'picked-up'])
                ->where(function($q) use ($start, $end) {
                    $q->whereBetween('completed_at', [$start, $end])
                      ->orWhereBetween('picked_up_at', [$start, $end]);
                })
                ->selectRaw('COALESCE(SUM(cost), 0) as total')
                ->value('total');

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
            'activities',
            'serviceRevenueToday'
        ));
    }
}
