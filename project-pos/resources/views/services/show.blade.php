@extends('layouts.app')

@section('title', 'Detail Servis - Mustika Komputer')
@section('header-title', 'Detail Servis')

@section('content')

    <a href="{{ route('services.history') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Riwayat
    </a>
    
    <div class="content-card">
        <div class="detail-layout">
            <div class="detail-main">
                <div class="service-header-info">
                    <div>
                        <h2>Servis #{{ $service->service_code }}</h2>
                        <div class="service-meta">
                            <span class="status-badge {{ $service->status_badge_class }}">Status: {{ $service->status_label }}</span>
                            <span style="margin-left:0.75rem;"><i data-feather="calendar" style="width:14px;"></i> Masuk: {{ $service->created_at ? $service->created_at->format('d M Y') : '-' }}</span>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="secondary-button" onclick="window.print()"><i data-feather="printer"></i> Cetak Invoice</button>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-block">
                        <h5>Info Pelanggan</h5>
                        <div class="info-item">
                            <i data-feather="user"></i>
                            <span>{{ $service->customer_name }}</span>
                        </div>
                        <div class="info-item">
                            <i data-feather="phone"></i>
                            <span>{{ $service->customer_phone ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="info-block">
                        <h5>Perangkat</h5>
                        <div class="info-item">
                            <i data-feather="monitor"></i>
                            <span>{{ $service->device_full_name }}</span>
                        </div>
                        <div class="info-item">
                            <i data-feather="package"></i>
                            <span>Kelengkapan: {{ $service->items_included ?? '-' }}</span>
                        </div>
                        
                    </div>
                </div>

                <div class="description-box">
                    <h5>Keluhan Awal:</h5>
                    <p>{{ $service->complaint }}</p>
                </div>

                @if(!empty($service->action_taken))
                <div class="description-box" style="background-color: #eef2ff; border-color: #e0e7ff;">
                    <h5>Tindakan Teknisi (Solusi):</h5>
                    <p>{{ $service->action_taken }}</p>
                </div>
                @endif

                <h5 style="margin-top: 2rem; margin-bottom: 1rem; color: #718096; font-size: 0.9rem;">Rincian Biaya</h5>
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Deskripsi Item / Jasa</th>
                            <th class="text-right">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Jika Anda menyimpan rincian item biaya di relasi/kolom terpisah, bisa loop di sini. Untuk sekarang tampilkan total saja. --}}
                        <tr class="total-row">
                            <td>Total Biaya</td>
                            <td class="text-right" style="color: #4F46E5;">Rp {{ number_format($service->cost ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="detail-sidebar">
                <h5 style="margin-bottom: 1.5rem; color: #718096; font-size: 0.9rem;">Jejak Servis</h5>

                <div class="timeline">

                    @if($service->picked_up_at)
                    <div class="timeline-item done">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h6>Sudah Diambil</h6>
                            <p>Perangkat diserahkan ke pelanggan.</p>
                            <span class="date">{{ $service->picked_up_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                    @endif

                    @if($service->completed_at)
                    <div class="timeline-item done">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h6>Selesai & QC</h6>
                            <p>Teknisi: {{ $service->technician ?? '-' }}.</p>
                            <span class="date">{{ $service->completed_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="timeline-item @if($service->status === 'progress') active @endif">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h6>{{ $service->status === 'progress' ? 'Sedang Dikerjakan' : 'Diterima' }}</h6>
                            <p>{{ $service->status === 'progress' ? 'Sedang dalam proses perbaikan.' : 'Diterima oleh Admin.' }}</p>
                            <span class="date">{{ $service->created_at ? $service->created_at->format('d M Y, H:i') : '-' }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    /* Minimal CSS, design diambil dari desain asli - ulang definisi yang diperlukan */
    .back-link { display: inline-flex; align-items: center; gap: 0.5rem; color: #4F46E5; text-decoration: none; font-weight: 600; margin-bottom: 1rem; }
    .back-link:hover { text-decoration: underline; }
    .content-card { background-color: #ffffff; padding: 2rem; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); margin-bottom: 2rem; }
    .detail-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
    .service-header-info { display:flex; justify-content:space-between; align-items:flex-start; padding-bottom:1.5rem; border-bottom:1px solid #eef2f7; margin-bottom:2rem; }
    .service-meta span { color:#718096; font-size:0.9rem; margin-right:1rem; }
    .status-badge { padding:0.3rem 0.75rem; border-radius:99px; font-size:0.85rem; font-weight:600; display:inline-block; }
    .info-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem; }
    .info-block h5 { font-size:0.85rem; color:#718096; text-transform:uppercase; margin-bottom:0.75rem; font-weight:600; }
    .info-item { display:flex; align-items:flex-start; gap:0.75rem; margin-bottom:0.75rem; }
    .description-box { background-color:#f8f9fa; border-radius:12px; padding:1.5rem; margin-bottom:1.5rem; border:1px solid #eef2f7; }
    .modern-table { width:100%; border-collapse:collapse; margin-top:1rem; }
    .modern-table th { text-align:left; padding:0.75rem; background-color:#f8f9fa; color:#718096; font-size:0.85rem; font-weight:600; border-bottom:2px solid #e2e8f0; }
    .modern-table td { padding:0.75rem; color:#2d3748; font-size:0.95rem; border-bottom:1px solid #eef2f7; }
    .text-right { text-align:right; }
    .total-row td { font-weight:700; color:#1a202c; font-size:1.1rem; border-top:2px solid #eef2f7; }
    .timeline { position:relative; padding-left:1.5rem; }
    .timeline::before { content:''; position:absolute; left:6px; top:5px; bottom:5px; width:2px; background-color:#eef2f7; }
    .timeline-item { position:relative; margin-bottom:2rem; }
    .timeline-dot { position:absolute; left:-1.5rem; top:2px; width:14px; height:14px; border-radius:50%; background-color:#e2e8f0; border:2px solid #ffffff; box-shadow:0 0 0 2px #eef2f7; }
    .timeline-item.done .timeline-dot { background-color:#10B981; box-shadow:0 0 0 2px #d1fae5; }
    .timeline-item.active .timeline-dot { background-color:#4F46E5; box-shadow:0 0 0 2px #e0e7ff; }
    .timeline-content h6 { font-size:0.95rem; font-weight:600; color:#1a202c; margin-bottom:0.25rem; }
    .timeline-content p { font-size:0.85rem; color:#718096; margin-bottom:0.25rem; }
    .timeline-content .date { font-size:0.75rem; color:#94a3b8; }
</style>
@endpush
