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

        // Hitung Penjualan Produk dari sale_items
        $productRevenue = (float) DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->selectRaw('COALESCE(SUM(sale_items.quantity * sale_items.price_per_unit), 0) as total')
            ->value('total');

        // Hitung Pendapatan Servis dari services (status done atau picked-up)
        $serviceRevenue = (float) DB::table('services')
            ->whereIn('status', ['done', 'picked-up'])
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->selectRaw('COALESCE(SUM(cost), 0) as total')
            ->value('total');

        // Format untuk view
        $stats = [
            'product_revenue' => $productRevenue,
            'service_revenue' => $serviceRevenue,
            'start_date' => $startDate,
            'end_date' => $endDate,
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

        // Ambil data penjualan produk
        $productRows = DB::table('sales')
            ->join('sale_items', 'sales.id', '=', 'sale_items.sale_id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->groupByRaw($groupFormat)
            ->selectRaw("
                {$groupFormat} as period,
                COALESCE(SUM(sale_items.quantity * sale_items.price_per_unit),0) as revenue
            ")
            ->get()
            ->keyBy('period');

        // Ambil data pendapatan servis
        $groupFormatService = str_replace('sales.created_at', 'services.completed_at', $groupFormat);
        $serviceRows = DB::table('services')
            ->whereIn('status', ['done', 'picked-up'])
            ->whereNotNull('completed_at')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->groupByRaw($groupFormatService)
            ->selectRaw("
                {$groupFormatService} as period,
                COALESCE(SUM(cost),0) as revenue
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
        $productData = [];
        $serviceData = [];

        foreach ($periods as $period) {
            $labels[] = Carbon::parse($period)->format($labelFormat);
            
            $productRev = isset($productRows[$period]) ? (float)$productRows[$period]->revenue : 0;
            $serviceRev = isset($serviceRows[$period]) ? (float)$serviceRows[$period]->revenue : 0;
            
            $productData[] = $productRev;
            $serviceData[] = $serviceRev;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Penjualan Produk',
                    'data' => $productData,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderWidth' => 3,
                    'fill' => true
                ],
                [
                    'label' => 'Pendapatan Servis',
                    'data' => $serviceData,
                    'borderColor' => '#7C3AED',
                    'backgroundColor' => 'rgba(124, 58, 237, 0.1)',
                    'borderWidth' => 3,
                    'fill' => true
                ]
            ]
        ]);
    }
}
