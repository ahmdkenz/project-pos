<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    use LogsActivity;

    /**
     * Menampilkan daftar servis
     */
    public function index(Request $request)
    {
        $query = Service::with('creator')->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Pagination
        $services = $query->paginate(25)->withQueryString();

        return view('services.index', compact('services'));
    }

    /**
     * Menampilkan form tambah servis
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Menyimpan servis baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'device_type' => ['required', 'string', 'max:255'],
            'device_brand' => ['nullable', 'string', 'max:100'],
            'complaint' => ['required', 'string'],
            'diagnosis' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,progress,done,picked-up'],
            'cost' => ['nullable', 'numeric', 'min:0'],
        ]);

        // Generate service code
        $data['service_code'] = Service::generateServiceCode();
        $data['created_by'] = Auth::id();
        $data['cost'] = $data['cost'] ?? 0;

        $service = Service::create($data);

        // Log activity
        $this->logActivity(
            'product',
            'CREATE',
            "menambahkan servis baru <strong>{$service->service_code}</strong> untuk pelanggan <strong>{$service->customer_name}</strong>"
        );

        return redirect()->route('services.index')->with('status', 'Servis berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit servis
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Update servis
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'device_type' => ['required', 'string', 'max:255'],
            'device_brand' => ['nullable', 'string', 'max:100'],
            'complaint' => ['required', 'string'],
            'diagnosis' => ['nullable', 'string'],
            'action_taken' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,progress,done,picked-up'],
            'cost' => ['nullable', 'numeric', 'min:0'],
        ]);

        $data['cost'] = $data['cost'] ?? 0;

        // Set timestamp sesuai status
        if ($data['status'] === 'done' && $service->status !== 'done') {
            $data['completed_at'] = now();
        }
        if ($data['status'] === 'picked-up' && $service->status !== 'picked-up') {
            $data['picked_up_at'] = now();
        }

        $service->update($data);

        // Log activity
        $this->logActivity(
            'product',
            'UPDATE',
            "mengupdate servis <strong>{$service->service_code}</strong> - Status: <strong>{$service->status_label}</strong>"
        );

        return redirect()->route('services.index')->with('status', 'Servis berhasil diupdate.');
    }

    /**
     * Hapus servis
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $serviceCode = $service->service_code;
        
        $service->delete();

        // Log activity
        $this->logActivity(
            'danger',
            'DELETE',
            "menghapus servis <strong>{$serviceCode}</strong>"
        );

        return redirect()->route('services.index')->with('status', 'Servis berhasil dihapus.');
    }
}
