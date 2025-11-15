@extends('layouts.app')

@section('title','Dashboard - Mustika Komputer')
@section('header-title','Dashboard')

@section('content')

    <div class="welcome-banner">
        <h1>SELAMAT DATANG DI APLIKASI MUSTIKA KOMPUTER</h1>
        <p>Ini adalah pusat kendali untuk bisnis Anda.</p>
    </div>

    <div class="widget-grid">
        <div class="widget-card">
            <h4>Penjualan Hari Ini</h4>
            <div class="widget-value">Rp {{ number_format($salesToday ?? 0, 0, ',', '.') }}</div>
            <div class="widget-change positive">Realtime</div>
        </div>
        <div class="widget-card">
            <h4>
                <i data-feather="tool" style="color: #4F46E5;"></i>
                Pendapatan Servis (Hari Ini)
            </h4>
            <div class="widget-value" style="color:#6D28D9">Rp {{ number_format($serviceRevenueToday ?? 0, 0, ',', '.') }}</div>
            <div class="widget-change positive">Realtime</div>
        </div>
        <div class="widget-card">
            <h4>Transaksi Hari Ini</h4>
            <div class="widget-value">{{ $transactionsToday ?? 0 }}</div>
            <div class="widget-change positive">Realtime</div>
        </div>
        <div class="widget-card">
            <h4>Barang Stok Kritis</h4>
            <div class="widget-value">{{ $criticalStockCount ?? 0 }}</div>
            <div class="widget-change negative">Perlu restock</div>
        </div>
    </div>

    <div class="content-card">
        <h3>Aktivitas Terbaru (Audit Log)</h3>
        <div class="activity-feed">
            <ul>
                @forelse($activities ?? [] as $activity)
                <li>
                    <div class="activity-icon" style="background-color: {{ $activity->color }}; color: {{ $activity->icon_color }};"> 
                        <i data-feather="{{ $activity->icon }}"></i>
                    </div>
                    <div class="activity-text">
                        <strong>{{ $activity->actor ?? $activity->user->name ?? 'System' }}</strong> {!! $activity->message !!}
                    </div>
                    <div class="activity-timestamp">{{ $activity->created_at->diffForHumans() }}</div>
                </li>
                @empty
                <li>
                    <div class="activity-text" style="text-align: center; width: 100%; color: #718096;">
                        Belum ada aktivitas tercatat.
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
    </div>

@endsection
