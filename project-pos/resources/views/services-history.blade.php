@extends('layouts.app')

@section('title', 'Riwayat Servis - Mustika Komputer')
@section('header-title', 'Riwayat Servis')

@section('content')

    <div class="content-card">
        <form class="filter-form-grid" method="GET" action="{{ route('services.history') }}">
            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="form-group">
                <label for="search">ID Servis / Pelanggan</label>
                <input type="text" id="search" name="search" placeholder="Contoh: SVC-004 atau Citra" value="{{ request('search') }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Cek</option>
                    <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Selesai (Belum Diambil)</option>
                    <option value="picked-up" {{ request('status') == 'picked-up' ? 'selected' : '' }}>Sudah Diambil</option>
                </select>
            </div>
            
            <button type="submit" class="cta-button" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">
                <i data-feather="filter"></i>
                Filter
            </button>
        </form>
    </div>
    
    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID Servis</th>
                    <th>Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Tanggal Buat</th>
                    <th>Status</th>
                    <th class="text-right">Total Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $svc)
                <tr>
                    <td><strong>{{ $svc->service_code }}</strong></td>
                    <td>{{ $svc->customer_name }}</td>
                    <td>{{ $svc->device_full_name }}</td>
                    <td>{{ $svc->created_at ? $svc->created_at->format('d M Y') : '-' }}</td>
                    <td><span class="status-badge {{ $svc->status_badge_class }}">{{ $svc->status_label }}</span></td>
                    <td class="text-right">Rp {{ number_format($svc->cost ?? 0, 0, ',', '.') }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('services.show', $svc->id) }}" title="Lihat Detail"><i data-feather="eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">Tidak ada data servis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:1rem;">
            {{ $services->withQueryString()->links() }}
        </div>
    </div>

@endsection
