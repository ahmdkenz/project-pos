<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesHistoryController extends Controller
{
    /**
     * Menampilkan riwayat penjualan user yang sedang login
     */
    public function index(Request $request)
    {
        $query = Sale::with(['items.product', 'user'])
            ->byUser(Auth::id()) // Hanya transaksi user yang login
            ->latest();

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Search invoice
        if ($request->filled('invoice_search')) {
            $query->searchInvoice($request->invoice_search);
        }

        // Pagination
        $sales = $query->paginate(25)->withQueryString();

        return view('sales-history', compact('sales'));
    }

    /**
     * Menampilkan detail invoice
     */
    public function show($id)
    {
        $sale = Sale::with(['items.product', 'user'])
            ->byUser(Auth::id()) // Pastikan hanya bisa lihat transaksi sendiri
            ->findOrFail($id);

        return view('sales-detail', compact('sale'));
    }
}
