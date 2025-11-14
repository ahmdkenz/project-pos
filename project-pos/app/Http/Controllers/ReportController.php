<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan profit
     */
    public function profit(Request $request)
    {
        // Default periode: bulan ini
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();
            
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        // Ambil data sale items dalam periode
        $saleItems = SaleItem::with('sale')
            ->whereHas('sale', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        // Hitung Total Penjualan (Gross Sales)
        $totalSales = $saleItems->sum(function($item) {
            return $item->quantity * $item->price_per_unit;
        });

        // Hitung Total Modal / COGS (Cost of Goods Sold)
        $totalCost = $saleItems->sum(function($item) {
            return $item->quantity * $item->cost_price_per_unit;
        });

        // Hitung Laba Bersih (Gross Profit)
        $grossProfit = $totalSales - $totalCost;

        // Format untuk view
        $stats = [
            'total_sales' => $totalSales,
            'total_cost' => $totalCost,
            'gross_profit' => $grossProfit,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return view('reports.profit', compact('stats'));
    }
}
