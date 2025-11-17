<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesHistoryController extends Controller
{
    /**
     * Display a listing of services (history) with filters similar to Sales History.
     */
    public function index(Request $request)
    {
        $query = Service::query()->latest();

        // Date range filter (based on created_at)
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $start = $request->filled('start_date') ? $request->start_date . ' 00:00:00' : null;
            $end = $request->filled('end_date') ? $request->end_date . ' 23:59:59' : null;

            if ($start && $end) {
                $query->whereBetween('created_at', [$start, $end]);
            } elseif ($start) {
                $query->where('created_at', '>=', $start);
            } elseif ($end) {
                $query->where('created_at', '<=', $end);
            }
        }

        // Status filter (uses scopeByStatus if provided)
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Search (service_code, customer_name, device_type, phone) using Service::scopeSearch
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $services = $query->paginate(25)->withQueryString();

        return view('services-history', compact('services'));
    }
}
