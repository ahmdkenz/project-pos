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

        // Data untuk grafik - Laba per hari
        $chartData = DB::table('sales')
            ->join('sale_items', 'sales.id', '=', 'sale_items.sale_id')
            ->select(
                DB::raw('DATE(sales.created_at) as date'),
                DB::raw('SUM(sale_items.quantity * sale_items.price_per_unit) as daily_sales'),
                DB::raw('SUM(sale_items.quantity * sale_items.cost_price_per_unit) as daily_cost')
            )
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->map(function($row) {
                return [
                    'date' => Carbon::parse($row->date)->format('d M'),
                    'profit' => $row->daily_sales - $row->daily_cost,
                    'sales' => $row->daily_sales,
                    'cost' => $row->daily_cost,
                ];
            });

        // Format untuk view
        $stats = [
            'total_sales' => $totalSales,
            'total_cost' => $totalCost,
            'gross_profit' => $grossProfit,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'chart_data' => $chartData,
        ];

        return view('reports.profit', compact('stats'));
    }
}
