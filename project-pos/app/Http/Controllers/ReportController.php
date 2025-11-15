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

        // Hitung Total Nilai Inventaris (current_stock * cost_price)
        $inventoryValue = DB::table('products')
            ->select(DB::raw('SUM(current_stock * cost_price) as total'))
            ->value('total') ?? 0;

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
            'inventory_value' => $inventoryValue,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'chart_data' => $chartData,
        ];

        return view('reports.profit', compact('stats'));
    }

    /**
     * API untuk data grafik profit berdasarkan range (harian/bulanan/tahunan)
     */
    public function profitChartData(Request $request)
    {
        $range = $request->input('range', 'daily'); // daily, monthly, yearly
        $now = Carbon::now();

        if ($range === 'monthly') {
            // 12 bulan terakhir
            $startDate = $now->copy()->subMonths(11)->startOfMonth();
            $endDate = $now->copy()->endOfMonth();
            $groupFormat = "DATE_FORMAT(sales.created_at,'%Y-%m')";
            $dateFormat = 'Y-m';
            $labelFormat = 'M Y';
        } elseif ($range === 'yearly') {
            // 5 tahun terakhir
            $startDate = $now->copy()->subYears(4)->startOfYear();
            $endDate = $now->copy()->endOfYear();
            $groupFormat = "DATE_FORMAT(sales.created_at,'%Y')";
            $dateFormat = 'Y';
            $labelFormat = 'Y';
        } else {
            // 30 hari terakhir (default: daily)
            $startDate = $now->copy()->subDays(29)->startOfDay();
            $endDate = $now->copy()->endOfDay();
            $groupFormat = "DATE_FORMAT(sales.created_at,'%Y-%m-%d')";
            $dateFormat = 'Y-m-d';
            $labelFormat = 'd M';
        }

        // Ambil data dari database
        $rows = DB::table('sales')
            ->join('sale_items', 'sales.id', '=', 'sale_items.sale_id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->groupByRaw($groupFormat)
            ->orderByRaw($groupFormat)
            ->selectRaw("
                {$groupFormat} as period,
                COALESCE(SUM(sale_items.quantity * sale_items.price_per_unit),0) as revenue,
                COALESCE(SUM(sale_items.quantity * sale_items.cost_price_per_unit),0) as cogs
            ")
            ->get()
            ->keyBy('period');

        // Generate continuous periods
        $periods = [];
        $tmp = $startDate->copy();
        
        if ($range === 'monthly') {
            for ($i = 0; $i < 12; $i++) {
                $periods[] = $tmp->format($dateFormat);
                $tmp->addMonth();
            }
        } elseif ($range === 'yearly') {
            for ($i = 0; $i < 5; $i++) {
                $periods[] = $tmp->format($dateFormat);
                $tmp->addYear();
            }
        } else {
            for ($i = 0; $i < 30; $i++) {
                $periods[] = $tmp->format($dateFormat);
                $tmp->addDay();
            }
        }

        // Map data ke periode
        $labels = [];
        $revenueData = [];
        $cogsData = [];
        $profitData = [];

        foreach ($periods as $period) {
            $labels[] = Carbon::parse($period)->format($labelFormat);
            
            $revenue = isset($rows[$period]) ? (float)$rows[$period]->revenue : 0;
            $cogs = isset($rows[$period]) ? (float)$rows[$period]->cogs : 0;
            
            $revenueData[] = $revenue;
            $cogsData[] = $cogs;
            $profitData[] = $revenue - $cogs;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Laba Bersih',
                    'data' => $profitData,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'borderWidth' => 3,
                    'fill' => true
                ],
                [
                    'label' => 'Total Penjualan',
                    'data' => $revenueData,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.05)',
                    'borderWidth' => 2,
                    'fill' => false
                ],
                [
                    'label' => 'Total Modal',
                    'data' => $cogsData,
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.05)',
                    'borderWidth' => 2,
                    'fill' => false
                ]
            ]
        ]);
    }
}
