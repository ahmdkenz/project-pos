@extends('layouts.app')

@section('title','Audit Log - Mustika Komputer')
@section('header-title','Riwayat Aktivitas (Audit Log)')

@section('content')

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
                    <td><strong>{{ $activity->actor ?? ($activity->user->name ?? 'System') }}</strong></td>
                    <td>
                        <span class="action-badge {{ $activity->type }}">
                            {{ strtoupper($activity->type == 'security' ? 'KEAMANAN' : ($activity->type == 'sales' ? 'PENJUALAN' : ($activity->type == 'product' ? 'PRODUK' : ($activity->type == 'stock' ? 'STOK' : ($activity->type == 'danger' ? 'HAPUS' : $activity->type))))) }}
                        </span>
                    </td>
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
        <div style="margin-top: 2rem;">
            {{ $activities->links() }}
        </div>
        @endif
    </div>

    <script>feather.replace()</script>

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

    /* Tabel Log (Reuse & Modifikasi) */
    .modern-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px; /* Lebar minimum agar muat */
    }
    .modern-table thead th {
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background-color: #f8f9fa;
        padding: 1rem 1.25rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .modern-table tbody td {
        padding: 1rem 1.25rem;
        font-size: 0.95rem;
        color: #2d3748;
        border-bottom: 1px solid #eef2f7;
    }

    /* Badge Aksi yang Modern/Futuristik */
    .action-badge {
        padding: 0.3rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        white-space: nowrap;
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

    /* Pagination styling sudah ada di layout global - tidak perlu duplikat */

</style>
@endpush
