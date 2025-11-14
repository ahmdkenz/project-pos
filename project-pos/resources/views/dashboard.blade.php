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
            <div class="widget-value">Rp 1.250.000</div>
            <div class="widget-change positive">+15% dari kemarin</div>
        </div>
        <div class="widget-card">
            <h4>Transaksi Hari Ini</h4>
            <div class="widget-value">42</div>
            <div class="widget-change positive">+5 dari kemarin</div>
        </div>
        <div class="widget-card">
            <h4>Barang Stok Kritis</h4>
            <div class="widget-value">3</div>
            <div class="widget-change negative">Perlu restock</div>
        </div>
    </div>

    <div class="content-card">
        <h3>Aktivitas Terbaru (Audit Log)</h3>
        <div class="activity-feed">
            <ul>
                <li>
                    <div class="activity-icon" style="background-color: #E0F2FE; color: #0284C7;"> <i data-feather="shopping-cart"></i>
                    </div>
                    <div class="activity-text">
                        <strong>Admin</strong> memproses penjualan baru <strong>(INV/2025/11/002)</strong>.
                    </div>
                    <div class="activity-timestamp">2 menit lalu</div>
                </li>
                <li>
                    <div class="activity-icon" style="background-color: #DEF7EC; color: #0E9F6E;"> <i data-feather="user-check"></i>
                    </div>
                    <div class="activity-text">
                        <strong>Admin</strong> berhasil login dari IP 103.44.1.2.
                    </div>
                    <div class="activity-timestamp">15 menit lalu</div>
                </li>
                <li>
                    <div class="activity-icon" style="background-color: #eef2ff; color: #4F46E5;"> <i data-feather="package"></i>
                    </div>
                    <div class="activity-text">
                        <strong>Admin</strong> mengedit produk <strong>(KB-XPRO-001)</strong>.
                    </div>
                    <div class="activity-timestamp">1 jam lalu</div>
                </li>
                <li>
                    <div class="activity-icon" style="background-color: #FEF3C7; color: #D97706;"> <i data-feather="database"></i>
                    </div>
                    <div class="activity-text">
                        <strong>Admin</strong> menambahkan stok untuk <strong>Mouse Gaming RGB (50 unit)</strong>.
                    </div>
                    <div class="activity-timestamp">3 jam lalu</div>
                </li>
            </ul>
        </div>
    </div>

@endsection
