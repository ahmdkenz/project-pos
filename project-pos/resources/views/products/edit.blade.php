@extends('layouts.app')
@section('title','Edit Produk - Mustika Komputer')
@section('header-title','Edit Produk')
@section('content')

    <div class="page-header">
        <div>
            <h1>Edit Produk</h1>
            <a href="{{ route('inventory') }}" class="back-link" style="margin-top:0.25rem; display:inline-block;">
                <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
                Kembali ke Manajemen Produk
            </a>
        </div>
    </div>
    
    <div class="content-card">
        @if ($errors->any())
            <div class="auth-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="updateForm" action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="sku">SKU (Kode Barang)</label>
                    <input type="text" id="sku" name="sku" value="{{ $product->sku }}" disabled>
                </div>

                <div class="form-group">
                    <label for="current_stock">Stok Saat Ini</label>
                    <input type="number" id="current_stock" name="current_stock" value="{{ old('current_stock', $product->current_stock) }}" min="0">
                </div>

                <div class="form-group">
                    <label for="cost_price">Harga Beli (Modal)</label>
                    <input type="number" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" min="0">
                </div>

                <div class="form-group">
                    <label for="sale_price">Harga Jual</label>
                    <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" min="0">
                </div>

            </div>
        </form>

        <div class="form-footer">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger-button">
                    <i data-feather="trash-2"></i>
                    Hapus Produk
                </button>
            </form>

            <div class="right-actions">
                <a href="{{ route('inventory') }}" class="secondary-button">Batal</a>
                <button type="submit" form="updateForm" class="cta-button"><i data-feather="save"></i> Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <script>feather.replace()</script>

@endsection
