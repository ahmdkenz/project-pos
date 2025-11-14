@extends('layouts.app')

@section('title','Tambah Produk Baru - Mustika Komputer')
@section('header-title','Tambah Produk Baru')

@section('content')

    <div class="page-header">
        <div>
            <h1>Tambah Produk Baru</h1>
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

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Keyboard Mechanical X-Pro" required>
                </div>

                <div class="form-group">
                    <label for="sku">SKU (Kode Barang)</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" placeholder="Contoh: KB-XPRO-001">
                </div>

                <div class="form-group">
                    <label for="initial_stock">Stok Awal</label>
                    <input type="number" id="initial_stock" name="initial_stock" value="{{ old('initial_stock',0) }}" placeholder="Contoh: 50" min="0">
                </div>

                <div class="form-group">
                    <label for="cost_price">Harga Beli (Modal)</label>
                    <input type="number" id="cost_price" name="cost_price" value="{{ old('cost_price') }}" placeholder="Contoh: 650000" min="0">
                </div>

                <div class="form-group">
                    <label for="sale_price">Harga Jual</label>
                    <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price') }}" placeholder="Contoh: 850000" min="0">
                </div>

            </div>

            <div class="form-footer">
                <a href="{{ route('inventory') }}" class="secondary-button">Batal</a>
                <button type="submit" class="cta-button"><i data-feather="save"></i> Simpan Produk</button>
            </div>
        </form>
    </div>

    <script>feather.replace()</script>

@endsection
