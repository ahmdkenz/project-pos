@extends('layouts.app')

@section('title','Manajemen Produk - Mustika Komputer')
@section('header-title','Manajemen Produk')

@section('content')

    <div class="page-header">
        <h1>Manajemen Produk</h1>
        <a href="{{ route('products.create') }}" class="cta-button">
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
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku ?? '-' }}</td>
                    <td>Rp {{ number_format($product->cost_price,0,',','.') }}</td>
                    <td>Rp {{ number_format($product->sale_price,0,',','.') }}</td>
                    <td class="stock-level {{ $product->current_stock <= ($product->min_stock_level ?? 0) ? 'low' : '' }}">{{ $product->current_stock }}</td>
                    <td class="action-buttons">
                        <a href="#" title="Edit"><i data-feather="edit-2"></i></a>
                        <a href="#" title="Hapus"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-header" style="margin-top: 2rem;">
        <h1>Barang Masuk / Restock</h1>
    </div>
    
    <div class="content-card">
        <form action="{{ route('inventory.restock') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product">Pilih Produk</label>
                <select id="product" name="product">
                    <option value="">-- Pilih produk yang akan di-restock --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} @if($p->sku) ({{ $p->sku }}) @endif</option>
                    @endforeach
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
