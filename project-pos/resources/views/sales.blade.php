@extends('layouts.app')

@section('title','Kasir (POS) - Mustika Komputer')
@section('header-title','Kasir (Point of Sale)')

@section('content')

    <div class="page-header">
        <h1>Kasir (Point of Sale)</h1>
    </div>

    <div class="pos-layout">

        <div class="pos-products">
            <div class="form-group">
                <input type="text" id="product_search" placeholder="Cari produk berdasarkan nama atau SKU...">
            </div>

            <div class="product-grid">
                <div class="product-card">
                    <h6>Keyboard Mechanical</h6>
                    <span>Rp 850.000</span>
                </div>
                <div class="product-card">
                    <h6>Mouse Gaming RGB</h6>
                    <span>Rp 420.000</span>
                </div>
                <div class="product-card">
                    <h6>Headset Virtual 7.1</h6>
                    <span>Rp 1.100.000</span>
                </div>
                <div class="product-card">
                    <h6>Monitor Ultrawide</h6>
                    <span>Rp 5.500.000</span>
                </div>
            </div>
        </div>

        <aside class="pos-cart">
            <div class="pos-cart-header">
                <h3>Keranjang Belanja</h3>
            </div>

            <div class="info-box">
                <p>Klik pada <b>Qty</b> atau <b>Harga</b> untuk mengubahnya (fitur tawar harga).</p>
            </div>

            <ul class="cart-item-list">
                <li class="cart-item">
                    <div class="cart-item-details">
                        <h5>Mouse Gaming RGB</h5>
                        <div class="cart-item-editable">
                            <label for="qty_1">Qty:</label>
                            <input type="number" id="qty_1" value="1" min="1">
                            <label for="price_1">Harga:</label>
                            <input type="text" id="price_1" value="420000">
                        </div>
                    </div>
                    <div class="cart-item-remove">
                        <button title="Hapus Item"><i data-feather="trash-2" style="width:20px; height:20px;"></i></button>
                    </div>
                </li>

                <li class="cart-item">
                    <div class="cart-item-details">
                        <h5>Keyboard Mechanical</h5>
                        <div class="cart-item-editable">
                            <label for="qty_2">Qty:</label>
                            <input type="number" id="qty_2" value="1" min="1">
                            <label for="price_2">Harga:</label>
                            <input type="text" id="price_2" value="800000" style="border-color:#4F46E5;color:#4F46E5;">
                        </div>
                    </div>
                    <div class="cart-item-remove">
                        <button title="Hapus Item"><i data-feather="trash-2" style="width:20px; height:20px;"></i></button>
                    </div>
                </li>
            </ul>

            <div class="cart-summary">
                <div class="summary-row"><span>Subtotal</span><span>Rp 1.220.000</span></div>
                <div class="summary-row"><span>Pajak (11%)</span><span>Rp 134.200</span></div>
                <div class="summary-row total"><span>Total</span><span>Rp 1.354.200</span></div>
                <button type="button" class="cta-button" style="margin-top:1.5rem;"><i data-feather="check-circle"></i> Proses Pembayaran</button>
            </div>
        </aside>
    </div>

    <div class="page-header" style="margin-top:3rem;">
        <h1>Riwayat Penjualan</h1>
    </div>

    <div class="content-card">
        <form class="filter-form">
            <div class="form-group"><label for="start_date">Tanggal Mulai</label><input type="date" id="start_date"></div>
            <div class="form-group"><label for="end_date">Tanggal Akhir</label><input type="date" id="end_date"></div>
            <button type="submit" class="cta-button" style="width:auto;padding:0.75rem 1.25rem;"><i data-feather="filter"></i> Filter</button>
        </form>
    </div>

    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>INV/2025/11/001</td>
                    <td>14 Nov 2025, 13:05</td>
                    <td>Rp 1.354.200</td>
                    <td>QRIS</td>
                    <td><span class="status-badge success">Lunas</span></td>
                    <td class="action-buttons"><a href="#" title="Lihat Detail"><i data-feather="eye"></i></a><a href="#" title="Cetak Ulang Struk"><i data-feather="printer"></i></a></td>
                </tr>
                <tr>
                    <td>INV/2025/11/002</td>
                    <td>14 Nov 2025, 11:30</td>
                    <td>Rp 1.100.000</td>
                    <td>Cash</td>
                    <td><span class="status-badge success">Lunas</span></td>
                    <td class="action-buttons"><a href="#" title="Lihat Detail"><i data-feather="eye"></i></a><a href="#" title="Cetak Ulang Struk"><i data-feather="printer"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
