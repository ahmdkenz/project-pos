@extends('layouts.app')

@section('title','Manajemen Produk - Mustika Komputer')
@section('header-title','Manajemen Produk')

@section('content')

    <div class="page-header">
        <h1>Manajemen Produk</h1>
        <a href="#" class="cta-button">
            <i data-feather="plus"></i>
            Tambah Produk Baru
        </a>
    </div>
    
    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>SKU (Kode)</th>
                    <th>Harga Beli (Modal)</th>
                    <th>Harga Jual</th>
                    <th>Stok Saat Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Keyboard Mechanical X-Pro</td>
                    <td>KB-XPRO-001</td>
                    <td>Rp 650.000</td>
                    <td>Rp 850.000</td>
                    <td class="stock-level">42</td>
                    <td class="action-buttons">
                        <a href="#" title="Edit"><i data-feather="edit-2"></i></a>
                        <a href="#" title="Hapus"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Mouse Gaming RGB 12000 DPI</td>
                    <td>MS-RGB-12K</td>
                    <td>Rp 300.000</td>
                    <td>Rp 420.000</td>
                    <td class="stock-level">75</td>
                    <td class="action-buttons">
                        <a href="#" title="Edit"><i data-feather="edit-2"></i></a>
                        <a href="#" title="Hapus"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Headset Virtual 7.1 Surround</td>
                    <td>HS-V71-SRD</td>
                    <td>Rp 800.000</td>
                    <td>Rp 1.100.000</td>
                    <td class="stock-level low">3</td>
                    <td class="action-buttons">
                        <a href="#" title="Edit"><i data-feather="edit-2"></i></a>
                        <a href="#" title="Hapus"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Monitor Ultrawide 34" 144Hz</td>
                    <td>MN-UW34-144</td>
                    <td>Rp 4.800.000</td>
                    <td>Rp 5.500.000</td>
                    <td class="stock-level">12</td>
                    <td class="action-buttons">
                        <a href="#" title="Edit"><i data-feather="edit-2"></i></a>
                        <a href="#" title="Hapus"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page-header" style="margin-top: 2rem;">
        <h1>Barang Masuk / Restock</h1>
    </div>
    
    <div class="content-card">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="product">Pilih Produk</label>
                <select id="product" name="product">
                    <option value="">-- Pilih produk yang akan di-restock --</option>
                    <option value="KB-XPRO-001">Keyboard Mechanical X-Pro</option>
                    <option value="MS-RGB-12K">Mouse Gaming RGB 12000 DPI</option>
                    <option value="HS-V71-SRD">Headset Virtual 7.1 Surround</option>
                    <option value="MN-UW34-144">Monitor Ultrawide 34" 144Hz</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="quantity">Jumlah Masuk</label>
                <input type="number" id="quantity" name="quantity" placeholder="Contoh: 50" min="1">
            </div>
            
            <div class="form-group">
                <label for="cost_price">Harga Beli / Modal (Per Unit)</label>
                <input type="number" id="cost_price" name="cost_price" placeholder="Contoh: 600000" min="0">
            </div>
            
            <button type="submit" class="cta-button full-width" style="margin-top: 1rem;">
                <i data-feather="save"></i>
                Simpan Stok
            </button>
        </form>
    </div>

    <script>feather.replace()</script>

@endsection
