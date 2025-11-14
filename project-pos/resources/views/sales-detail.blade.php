@extends('layouts.app')

@section('title','Detail Invoice - Mustika Komputer')
@section('header-title','Detail Invoice')

@section('content')

    <a href="{{ route('sales.history') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Riwayat Penjualan
    </a>
    
    <div class="page-header" style="margin-bottom: 0; margin-top: 1rem;">
        <h1>Detail Invoice</h1>
        <div class="page-actions">
            <button type="button" class="secondary-button" onclick="alert('Fitur download PDF akan segera hadir!')">
                <i data-feather="download"></i>
                Download PDF
            </button>
            <button type="button" class="cta-button" onclick="window.print()">
                <i data-feather="printer"></i>
                Cetak Struk
            </button>
        </div>
    </div>

    
    <div class="content-card">
        
        <div class="invoice-header">
            
            <div class="invoice-info">
                <h5>INVOICE</h5>
                <p class="strong" style="font-size: 1.75rem; color: #1a202c;">{{ $sale->invoice_number }}</p>
            </div>
                                
            <div class="invoice-info" style="text-align: right;">
                <h5>DETAIL</h5>
                <p>
                    Tanggal: {{ $sale->created_at->format('d F Y') }}<br>
                    Metode Bayar: {{ $sale->payment_method }}<br>
                    Status: <span class="status-badge {{ $sale->status_badge_class }}">{{ strtoupper($sale->status) }}</span>
                </p>
            </div>
        </div>

        <table class="modern-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga Satuan</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->name ?? 'Produk Dihapus' }}</strong><br>
                        <small style="color: #718096;">{{ $item->product->sku ?? '-' }}</small>
                    </td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="invoice-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($sale->items->sum('subtotal'), 0, ',', '.') }}</span>
            </div>
            <div class="summary-row grand-total">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>
        
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
    .back-link:hover {
        text-decoration: underline;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .page-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a202c;
    }

    .page-actions {
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
        font-size: 0.95rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.2s ease;
    }
    .secondary-button:hover {
        background-color: #f8f9fa;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eef2f7;
        margin-bottom: 2rem;
    }
    
    .invoice-info h5 {
        font-size: 0.875rem;
        font-weight: 600;
        color: #718096;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }
    
    .invoice-info p {
        font-weight: 500;
        color: #2d3748;
        line-height: 1.6;
        margin: 0;
    }
    
    .invoice-info p.strong {
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 99px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 0.5rem;
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

    .modern-table tbody td strong {
        font-weight: 600;
    }

    /* Invoice Summary */
    .invoice-summary {
        width: 100%;
        max-width: 350px;
        margin-left: auto;
        margin-top: 2rem;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        font-size: 0.95rem;
        color: #4a5568;
        border-bottom: 1px solid #eef2f7;
    }
    
    .summary-row.grand-total {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a202c;
        border-top: 2px solid #3B82F6;
        padding-top: 1rem;
    }
    
    .summary-row span:last-child {
        font-weight: 600;
        color: #1a202c;
    }

    /* Print styles */
    @media print {
        .sidebar,
        .main-header,
        .back-link,
        .page-actions,
        .main-footer {
            display: none !important;
        }
        .main-content {
            margin-left: 0;
            padding: 1rem;
        }
        .content-card {
            box-shadow: none;
            border: 1px solid #e2e8f0;
        }
    }
</style>
@endpush
