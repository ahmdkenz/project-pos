@extends('layouts.app')

@section('title','Manajemen Jasa Servis - Mustika Komputer')
@section('header-title','Manajemen Jasa Servis')

@section('content')

    @if(session('status'))
    <div class="alert alert-success" style="background-color: #DEF7EC; color: #0E9F6E; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
        {{ session('status') }}
    </div>
    @endif

    <div class="service-page-header">
        <div class="filter-tabs">
            <a href="{{ route('services.index') }}" class="filter-tab {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">Semua</a>
            <a href="{{ route('services.index', ['status' => 'pending']) }}" class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}">Menunggu Cek</a>
            <a href="{{ route('services.index', ['status' => 'progress']) }}" class="filter-tab {{ request('status') == 'progress' ? 'active' : '' }}">Dalam Pengerjaan</a>
            <a href="{{ route('services.index', ['status' => 'done']) }}" class="filter-tab {{ request('status') == 'done' ? 'active' : '' }}">Selesai (Siap Ambil)</a>
            <a href="{{ route('services.index', ['status' => 'picked-up']) }}" class="filter-tab {{ request('status') == 'picked-up' ? 'active' : '' }}">Sudah Diambil</a>
        </div>
        
        <a href="{{ route('services.create') }}" class="cta-button">
            <i data-feather="plus"></i>
            Tambah Servis Baru
        </a>
    </div>
    
    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID Servis</th>
                    <th>Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th class="text-right">Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td><strong>{{ $service->service_code }}</strong></td>
                    <td>{{ $service->customer_name }}</td>
                    <td>{{ $service->device_full_name }}</td>
                    <td>{{ Str::limit($service->complaint, 50) }}</td>
                    <td><span class="status-badge {{ $service->status_badge_class }}">{{ $service->status_label }}</span></td>
                    <td class="text-right">Rp {{ number_format($service->cost, 0, ',', '.') }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('services.edit', $service->id) }}" title="Lihat/Edit Detail">
                            <i data-feather="edit-2"></i>
                        </a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus servis ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; padding: 0; color: #EF4444; cursor: pointer;" title="Hapus">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem; color: #718096;">
                        Belum ada data servis. Klik "Tambah Servis Baru" untuk memulai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($services->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $services->links() }}
        </div>
        @endif
    </div>

@endsection

@push('styles')
<style>
    .alert {
        animation: slideDown 0.3s ease-out;
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Service Page Header */
    .service-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    /* Filter Tab Modern & Futuristik */
    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        background-color: #eef2f7;
        border-radius: 10px;
        padding: 0.5rem;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 transparent;
    }
    .filter-tabs::-webkit-scrollbar {
        height: 6px;
    }
    .filter-tabs::-webkit-scrollbar-track {
        background: transparent;
    }
    .filter-tabs::-webkit-scrollbar-thumb {
        background-color: #cbd5e0;
        border-radius: 10px;
    }
    
    .filter-tab {
        background-color: transparent;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: #4a5568;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        white-space: nowrap;
        flex: 0 0 auto;
        min-width: 140px;
    }
    @media (max-width: 768px) {
        .filter-tab {
            min-width: 120px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }
    }
    
    .filter-tab:hover {
        background-color: #ffffff;
    }
    
    .filter-tab.active {
        background-image: linear-gradient(90deg, #4F46E5, #3B82F6);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
    }

    /* Text alignment */
    .modern-table thead th.text-right,
    .modern-table tbody td.text-right {
        text-align: right;
    }

    /* Badge Status Servis */
    .status-badge {
        padding: 0.3rem 0.75rem;
        border-radius: 99px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-badge.pending {
        background-color: #FEF3C7;
        color: #D97706;
    }
    .status-badge.progress {
        background-color: #eef2ff;
        color: #4F46E5;
    }
    .status-badge.done {
        background-color: #DEF7EC;
        color: #0E9F6E;
    }
    .status-badge.picked-up {
        background-color: #e2e8f0;
        color: #4a5568;
    }
    
    /* Action buttons */
    .action-buttons a,
    .action-buttons button {
        color: #718096;
        text-decoration: none;
        margin-right: 0.75rem;
        transition: color 0.3s;
    }
    .action-buttons a:hover {
        color: #4F46E5;
    }
    .action-buttons button:hover {
        color: #DC2626 !important;
    }

    /* Pagination */
    .pagination {
        display: flex;
        list-style: none;
        gap: 0.5rem;
        padding: 0;
        margin: 0;
    }
    
    .pagination li {
        display: inline-block;
    }
    
    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 0.5rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        color: #4a5568;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .pagination a:hover {
        background-color: #eef2ff;
        color: #4F46E5;
        border-color: #4F46E5;
    }
    
    .pagination .active span {
        background-color: #4F46E5;
        color: white;
        border-color: #4F46E5;
    }
    
    .pagination .disabled span {
        color: #cbd5e0;
        cursor: not-allowed;
    }
</style>
@endpush
