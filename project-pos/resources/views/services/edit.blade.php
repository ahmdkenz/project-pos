@extends('layouts.app')

@section('title','Edit Servis - Mustika Komputer')
@section('header-title','Edit Servis')

@section('content')

    <a href="{{ route('services.index') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Manajemen Servis
    </a>
    
    <div class="content-card">
        <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #eef2f7;">
            <h3 style="font-size: 1.25rem; font-weight: 600; color: #1a202c;">{{ $service->service_code }}</h3>
            <p style="color: #718096; margin-top: 0.25rem;">Edit detail servis untuk {{ $service->customer_name }}</p>
        </div>

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="form-grid">
                
                <div class="form-group">
                    <label for="customer_name">Nama Pelanggan</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $service->customer_name) }}" placeholder="Contoh: Budi Santoso" required>
                </div>
                
                <div class="form-group">
                    <label for="customer_phone">Nomor Telepon (WA)</label>
                    <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $service->customer_phone) }}" placeholder="Contoh: 0812xxxxxx" required>
                </div>
                
                <div class="form-group">
                    <label for="device_type">Tipe Perangkat</label>
                    <select id="device_type" name="device_type">
                        <option value="Laptop" {{ old('device_type', $service->device_type) == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="PC" {{ old('device_type', $service->device_type) == 'PC' ? 'selected' : '' }}>PC / Komputer</option>
                        <option value="Monitor" {{ old('device_type', $service->device_type) == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                        <option value="Printer" {{ old('device_type', $service->device_type) == 'Printer' ? 'selected' : '' }}>Printer</option>
                        <option value="Lainnya" {{ old('device_type', $service->device_type) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="device_model">Merk & Model</label>
                    <input type="text" id="device_model" name="device_brand" value="{{ old('device_brand', $service->device_brand) }}" placeholder="Contoh: Asus ROG G14">
                </div>
                
                <div class="form-group full-width">
                    <label for="complaint">Keluhan Pelanggan</label>
                    <textarea id="complaint" name="complaint" placeholder="Tuliskan keluhan yang disampaikan pelanggan, misal: Mati total, tidak bisa charge, blue screen..." required>{{ old('complaint', $service->complaint) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="items_included">Kelengkapan Barang</label>
                    <textarea id="items_included" name="items_included" placeholder="Tuliskan barang apa saja yang disertakan, misal: Unit Laptop, Charger Original, Tas Laptop">{{ old('items_included', $service->items_included) }}</textarea>
                </div>
                
                <div class="form-group full-width">
                    <label for="action_taken">Tindakan yang Dilakukan</label>
                    <textarea id="action_taken" name="action_taken" placeholder="Tindakan perbaikan yang dilakukan...">{{ old('action_taken', $service->action_taken) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="estimated_cost">Estimasi Biaya (Rp)</label>
                    <input type="number" id="estimated_cost" name="cost" value="{{ old('cost', $service->cost) }}" placeholder="0" min="0">
                </div>
                
                <!-- Field 'Ditugaskan ke Teknisi' dihapus sesuai permintaan -->

                <div class="form-group full-width">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="pending" {{ old('status', $service->status) == 'pending' ? 'selected' : '' }}>Menunggu Cek</option>
                        <option value="progress" {{ old('status', $service->status) == 'progress' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                        <option value="done" {{ old('status', $service->status) == 'done' ? 'selected' : '' }}>Selesai (Siap Ambil)</option>
                        <option value="picked-up" {{ old('status', $service->status) == 'picked-up' ? 'selected' : '' }}>Sudah Diambil</option>
                    </select>
                </div>

            </div>
            
            <div class="form-footer">
                <a href="{{ route('services.index') }}" class="secondary-button">
                    Batal
                </a>
                <button type="submit" class="cta-button">
                    <i data-feather="save"></i>
                    Update Servis
                </button>
            </div>
            
        </form>
    </div>

@endsection

@push('styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #4F46E5;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .back-link:hover { text-decoration: underline; }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); 
        gap: 1.5rem;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-footer {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eef2f7;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .secondary-button {
        padding: 0.85rem 1.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: #ffffff;
        color: #4a5568;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.2s ease;
    }
    .secondary-button:hover { background-color: #f8f9fa; }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23718096' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1em;
        padding-right: 2.5rem;
    }
</style>
@endpush
