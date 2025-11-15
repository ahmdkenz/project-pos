@extends('layouts.app')

@section('title','Laporan Profit - Mustika Komputer')

@section('content')

    <div class="page-header">
        <h1>Laporan Profit (Laba)</h1>
    </div>

    <div class="content-card">
        
        <div class="filter-tabs">
            <button type="button" class="tab-btn" data-tab="daily">Harian</button>
            <button type="button" class="tab-btn active" data-tab="monthly">Bulanan</button>
            <button type="button" class="tab-btn" data-tab="yearly">Tahunan</button>
        </div>
        
        <form method="GET" action="{{ route('reports.profit') }}" class="filter-form-grid">
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
    
    <div class="widget-grid" style="grid-template-columns: repeat(2, 1fr);">
        
        <div class="widget-card">
            <h4>
                <i data-feather="shopping-cart" style="color: #3B82F6;"></i>
                Penjualan Produk
            </h4>
            <div class="widget-value sales">Rp {{ number_format($stats['product_revenue'] ?? 0, 0, ',', '.') }}</div>
        </div>
        
        <div class="widget-card">
            <h4>
                <i data-feather="tool" style="color: #4F46E5;"></i>
                Pendapatan Servis
            </h4>
            <div class="widget-value service">Rp {{ number_format($stats['service_revenue'] ?? 0, 0, ',', '.') }}</div>
        </div>

    </div>
    
    <div class="content-card" style="margin-top: 2rem;">
        <h3>Grafik Penjualan (Bulanan)</h3>
        <canvas id="profitChart" style="max-height: 400px;"></canvas>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('profitChart').getContext('2d');
        let chart = null;
        let currentRange = 'monthly'; // Default
        
        // Function untuk fetch dan render chart
        function fetchAndRenderChart(range) {
            // Update judul grafik
            const titles = {
                'daily': 'Grafik Penjualan (Harian)',
                'monthly': 'Grafik Penjualan (Bulanan)',
                'yearly': 'Grafik Penjualan (Tahunan)'
            };
            document.querySelector('.content-card h3').textContent = titles[range] || 'Grafik Penjualan';
            
            fetch('{{ route('reports.profit.data') }}?range=' + range)
                .then(response => response.json())
                .then(data => {
                    const config = {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: data.datasets.map(ds => ({
                                label: ds.label,
                                data: ds.data,
                                borderColor: ds.borderColor,
                                backgroundColor: ds.backgroundColor,
                                borderWidth: ds.borderWidth,
                                fill: ds.fill,
                                tension: 0.4,
                                pointRadius: ds.borderWidth === 3 ? 5 : 4,
                                pointHoverRadius: ds.borderWidth === 3 ? 7 : 6,
                                pointBackgroundColor: ds.borderColor,
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                            }))
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        font: {
                                            family: 'Poppins',
                                            size: 12,
                                            weight: '600'
                                        },
                                        padding: 15,
                                        usePointStyle: true,
                                        pointStyle: 'circle'
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleFont: {
                                        family: 'Poppins',
                                        size: 13,
                                        weight: '600'
                                    },
                                    bodyFont: {
                                        family: 'Poppins',
                                        size: 12
                                    },
                                    padding: 12,
                                    displayColors: true,
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.dataset.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                            return label;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f3f4f6',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        font: {
                                            family: 'Poppins',
                                            size: 11
                                        },
                                        color: '#718096',
                                        callback: function(value) {
                                            return 'Rp ' + new Intl.NumberFormat('id-ID', { 
                                                notation: 'compact',
                                                compactDisplay: 'short'
                                            }).format(value);
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        font: {
                                            family: 'Poppins',
                                            size: 11
                                        },
                                        color: '#718096'
                                    }
                                }
                            },
                            interaction: {
                                mode: 'index',
                                intersect: false
                            }
                        }
                    };
                    
                    if (chart) {
                        chart.destroy();
                    }
                    chart = new Chart(ctx, config);
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        }
        
        // Event listeners untuk filter tabs
        document.querySelectorAll('.filter-tabs .tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                document.querySelectorAll('.filter-tabs .tab-btn').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
                
                // Fetch data dengan range baru
                const rangeMap = {
                    'daily': 'daily',
                    'monthly': 'monthly',
                    'yearly': 'yearly'
                };
                currentRange = rangeMap[this.dataset.tab];
                fetchAndRenderChart(currentRange);
            });
        });
        
        // Load default chart (monthly)
        fetchAndRenderChart('monthly');
    });
    </script>
@endpush
