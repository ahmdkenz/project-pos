@extends('layouts.app')

@section('title','Riwayat Penjualan - Mustika Komputer')
@section('header-title','Riwayat Penjualan')

@section('content')

    <div class="content-card">
        <form method="GET" action="{{ route('sales.history') }}" class="filter-form-grid">
            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="form-group">
                <label for="invoice_search">Cari ID Invoice</label>
                <input type="text" id="invoice_search" name="invoice_search" placeholder="Contoh: INV/2025/11/001" value="{{ request('invoice_search') }}">
            </div>
            
            <button type="submit" class="cta-button">
                <i data-feather="filter"></i>
                Filter
            </button>
        </form>
    </div>
    
    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th class="text-right">Total</th>
                    <th>Metode Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td><strong>{{ $sale->invoice_number }}</strong></td>
                    <td>{{ $sale->created_at->format('d M Y, H:i') }}</td>
                    <td class="text-right">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $sale->payment_method }}</td>
                    <td><span class="status-badge {{ $sale->status_badge_class }}">{{ $sale->status }}</span></td>
                    <td class="action-buttons">
                        <a href="{{ route('sales.detail', $sale->id) }}" title="Lihat Detail">
                            <i data-feather="eye"></i>
                        </a>
                        <a href="#" onclick="window.print(); return false;" title="Cetak Ulang Struk">
                            <i data-feather="printer"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: #718096;">
                        Tidak ada riwayat penjualan. Mulai transaksi pertama Anda di halaman Kasir (POS).
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($sales->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $sales->links() }}
        </div>
        @endif
    </div>

@endsection

@push('styles')
<style>
    /* Grid untuk form filter - 4 kolom */
    .filter-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 2fr auto;
        gap: 1rem;
        align-items: flex-end;
    }
    
    .filter-form-grid .form-group {
        margin-bottom: 0;
    }
    
    .filter-form-grid .cta-button {
        width: 100%;
    }

    /* Badge Status */
    .status-badge {
        padding: 0.3rem 0.75rem;
        border-radius: 99px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-badge.success {
        background-color: #DEF7EC;
        color: #0E9F6E;
    }

    /* Text alignment */
    .modern-table thead th.text-right,
    .modern-table tbody td.text-right {
        text-align: right;
    }

    /* Action buttons */
    .action-buttons a {
        color: #718096;
        text-decoration: none;
        margin-right: 0.75rem;
        transition: color 0.3s;
    }
    .action-buttons a:hover {
        color: #4F46E5;
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
