@extends('layouts.app')

@section('title','Laporan Profit - Mustika Komputer')

@section('content')

    <div class="page-header">
        <h1>Laporan Profit (Laba)</h1>
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
        <canvas id="profitChart" style="max-height: 400px;"></canvas>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('profitChart').getContext('2d');
        
        const chartData = @json($stats['chart_data']);
        
        const labels = chartData.map(item => item.date);
        const profitData = chartData.map(item => item.profit);
        const salesData = chartData.map(item => item.sales);
        const costData = chartData.map(item => item.cost);
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Laba Bersih',
                        data: profitData,
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                    },
                    {
                        label: 'Total Penjualan',
                        data: salesData,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                    },
                    {
                        label: 'Total Modal',
                        data: costData,
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#EF4444',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                    }
                ]
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
        });
    });
    </script>
@endpush
