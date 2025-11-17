@extends('layouts.app')

@section('title', 'Riwayat Servis - Mustika Komputer')
@section('header-title', 'Riwayat Servis')

@section('content')

    <div class="content-card">
        <form class="filter-form-grid">
            <div class="form-group">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" id="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Akhir</label>
                <input type="date" id="end_date">
            </div>
            <div class="form-group">
                <label for="search_query">ID Servis / Pelanggan</label>
                <input type="text" id="search_query" placeholder="Contoh: SVC-004 atau Citra">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status">
                    <option value="">Semua Status Selesai</option>
                    <option value="done">Selesai (Belum Diambil)</option>
                    <option value="picked-up">Sudah Diambil</option>
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
                    <th>Tanggal Diambil</th>
                    <th>Status</th>
                    <th class="text-right">Total Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>SVC-004</strong></td>
                    <td>Citra Lestari</td>
                    <td>Macbook Pro M1</td>
                    <td>14 Nov 2025</td>
                    <td><span class="status-badge picked-up">Sudah Diambil</span></td>
                    <td class="text-right">Rp 4.500.000</td>
                    <td class="action-buttons">
                        <a href="#" title="Lihat Detail"><i data-feather="eye"></i></a>
                    </td>
                </tr>
                
                <tr>
                    <td><strong>SVC-002</strong></td>
                    <td>Ani Wijaya</td>
                    <td>PC Rakitan</td>
                    <td>-</td> <td><span class="status-badge done">Selesai</span></td>
                    <td class="text-right">Rp 150.000</td>
                    <td class="action-buttons">
                        <a href="#" title="Lihat Detail"><i data-feather="eye"></i></a>
                    </td>
                </tr>
                
                <tr>
                    <td><strong>SVC-005</strong></td>
                    <td>David Lee</td>
                    <td>Printer Epson L3110</td>
                    <td>13 Nov 2025</td>
                    <td><span class="status-badge picked-up">Sudah Diambil</span></td>
                    <td class="text-right">Rp 200.000</td>
                    <td class="action-buttons">
                        <a href="#" title="Lihat Detail"><i data-feather="eye"></i></a>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>

@endsection
