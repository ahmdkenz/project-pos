<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        // Filter berdasarkan tipe aktivitas
        if ($request->filled('activity_type')) {
            $query->ofType($request->activity_type);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Pagination
        $activities = $query->paginate(25)->withQueryString();

        return view('audit-log', compact('activities'));
    }
}
