@extends('layouts.app')

@section('title','Audit Log - Mustika Komputer')
@section('header-title','Audit Log System')

@section('content')

    <div class="page-header">
        <h1>Riwayat Aktivitas (Audit Log)</h1>
    </div>
    
    <div class="content-card">
        <form method="GET" action="{{ route('audit-log') }}" class="filter-form-grid">
            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="form-group">
                <label for="activity_type">Tipe Aktivitas</label>
                <select id="activity_type" name="activity_type">
                    <option value="">Semua Tipe</option>
                    <option value="sales" {{ request('activity_type') == 'sales' ? 'selected' : '' }}>Penjualan</option>
                    <option value="product" {{ request('activity_type') == 'product' ? 'selected' : '' }}>Produk</option>
                    <option value="stock" {{ request('activity_type') == 'stock' ? 'selected' : '' }}>Stok</option>
                    <option value="security" {{ request('activity_type') == 'security' ? 'selected' : '' }}>Keamanan (Login)</option>
                    <option value="danger" {{ request('activity_type') == 'danger' ? 'selected' : '' }}>Hapus</option>
                </select>
            </div>
            
            <div style="grid-column: span 2;"></div> 
            
            <button type="submit" class="cta-button">
                <i data-feather="filter"></i>
                Filter Log
            </button>
        </form>
    </div>
    
    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Aktor</th>
                    <th>Aksi</th>
                    <th>Detail Aktivitas</th>
                    <th>IP Address</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr>
                    <td><strong>{{ $activity->actor ?? $activity->user->name ?? 'System' }}</strong></td>
                    <td><span class="action-badge {{ $activity->type }}">{{ strtoupper($activity->type) }}</span></td>
                    <td>{!! $activity->message !!}</td>
                    <td>{{ $activity->ip_address ?? '-' }}</td>
                    <td>{{ $activity->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem; color: #718096;">
                        Tidak ada data audit log. Filter mungkin terlalu spesifik atau belum ada aktivitas tercatat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($activities->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $activities->links() }}
        </div>
        @endif
    </div>

@endsection

@push('styles')
<style>
    /* Grid untuk form filter */
    .filter-form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 kolom */
        gap: 1rem;
        align-items: flex-end; /* Tombol sejajar dengan bawah input */
    }
    
    .filter-form-grid .form-group {
        margin-bottom: 0;
    }
    
    .filter-form-grid .cta-button {
        width: 100%;
    }

    /* Badge Aksi yang Modern/Futuristik */
    .action-badge {
        padding: 0.3rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
    }
    
    .action-badge.sales {
        background-color: #E0F2FE; /* Biru Muda */
        color: #0284C7;
    }
    .action-badge.product {
        background-color: #eef2ff; /* Ungu Muda */
        color: #4F46E5;
    }
    .action-badge.stock {
        background-color: #FEF3C7; /* Kuning Muda */
        color: #D97706;
    }
    .action-badge.security {
        background-color: #DEF7EC; /* Hijau Muda */
        color: #0E9F6E;
    }
    .action-badge.danger {
        background-color: #FEE2E2; /* Merah Muda */
        color: #DC2626;
    }

    /* Pagination styling */
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
