@extends('layouts.app')

@section('title','Laporan Profit - Mustika Komputer')
@section('header-title','Laporan Profit')

@section('content')

    <div class="page-header">
       
    </div>
    
    <div class="content-card">
        <form method="GET" action="{{ route('reports.profit') }}" class="filter-form">
            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date', $stats['start_date']->format('Y-m-d')) }}">
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date', $stats['end_date']->format('Y-m-d')) }}">
            </div>
            <button type="submit" class="cta-button">
                <i data-feather="filter"></i>
                Terapkan Filter
            </button>
        </form>
    </div>
    
    <div class="widget-grid">
        
        <div class="widget-card">
            <h4>
                <i data-feather="trending-up" style="color: #3B82F6;"></i>
                Total Penjualan (Omzet)
            </h4>
            <div class="widget-value sales">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</div>
        </div>
        
        <div class="widget-card">
            <h4>
                <i data-feather="trending-down" style="color: #EF4444;"></i>
                Total Modal (HPP)
            </h4>
            <div class="widget-value cost">Rp {{ number_format($stats['total_cost'], 0, ',', '.') }}</div>
        </div>
        
        <div class="widget-card">
            <h4>
                <i data-feather="dollar-sign" style="color: #10B981;"></i>
                Laba Bersih (Profit)
            </h4>
            <div class="widget-value profit">Rp {{ number_format($stats['gross_profit'], 0, ',', '.') }}</div>
        </div>

    </div>
    
    <div class="content-card" style="margin-top: 2rem;">
        <h3>Grafik Laba per Periode</h3>
        <div class="chart-placeholder">
            (Placeholder untuk Grafik Futuristik - misal: Chart.js)
        </div>
    </div>

@endsection

@push('styles')
<style>
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

    /* Form Filter */
    .filter-form {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
    }
    .filter-form .form-group {
        flex: 1;
        margin-bottom: 0;
    }
    .filter-form button {
        flex-shrink: 0;
        width: auto;
    }
    
    /* Grid untuk Kartu KPI */
    .widget-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .widget-card {
        background-color: #ffffff;
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid #eef2f7;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    }
    
    .widget-card h4 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .widget-value {
        font-size: 2.25rem;
        font-weight: 700;
        margin-top: 0.5rem;
    }
    
    /* Warna spesifik untuk kartu profit */
    .widget-value.sales {
        color: #3B82F6; /* Biru */
    }
    .widget-value.cost {
        color: #EF4444; /* Merah */
    }
    .widget-value.profit {
        color: #10B981; /* Hijau */
    }
    
    /* Placeholder untuk Grafik/Chart */
    .chart-placeholder {
        width: 100%;
        height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border: 1px dashed #e2e8f0;
        border-radius: 12px;
        color: #718096;
        font-weight: 500;
    }
    
    .content-card h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 1.5rem;
    }
</style>
@endpush
