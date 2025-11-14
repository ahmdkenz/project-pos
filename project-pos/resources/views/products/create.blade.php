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
                    <div style="display:flex;gap:0.5rem;align-items:center;">
                        <input type="text" id="sku" name="sku" value="{{ old('sku') }}" placeholder="Contoh: KB-XPRO-001" style="flex:1;">
                        <button type="button" id="generate_sku_btn" class="secondary-button" style="white-space:nowrap;">Generate SKU</button>
                    </div>
                    <div style="margin-top:0.5rem;display:flex;gap:0.75rem;align-items:center;">
                        <label style="font-size:0.9rem;display:flex;align-items:center;gap:0.5rem;">
                            <input type="checkbox" id="auto_generate_sku" checked>
                            <span>Auto-generate dari nama</span>
                        </label>
                        <div style="font-size:0.9rem;color:#666;">Preview: <span id="sku_preview">{{ old('sku') ?? '-' }}</span></div>
                    </div>
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

    <script>
        (function(){
            const nameInput = document.getElementById('name');
            const skuInput = document.getElementById('sku');
            const previewEl = document.getElementById('sku_preview');
            const genBtn = document.getElementById('generate_sku_btn');
            const autoChk = document.getElementById('auto_generate_sku');

            function sanitizeNameForSku(name){
                let s = name.replace(/[^A-Za-z0-9]+/g, '-');
                s = s.replace(/^-+|-+$/g, '');
                s = s.toUpperCase();
                if(s.length > 50) s = s.substring(0,50);
                return s;
            }

            function randomHex(len){
                let out = '';
                for(let i=0;i<len;i++) out += Math.floor(Math.random()*16).toString(16);
                return out.toUpperCase();
            }

            function generateSkuFromName(name){
                const part = sanitizeNameForSku(name || 'PRODUCT');
                const code = randomHex(6);
                return `PRD-${part}-${code}`;
            }

            function updatePreviewAndInput(newSku, setInput){
                previewEl.textContent = newSku;
                if(setInput) skuInput.value = newSku;
            }

            // on name change, if auto-generate checked and sku hasn't been manually edited, generate
            nameInput.addEventListener('input', function(){
                if(!autoChk.checked) return;
                const sku = generateSkuFromName(nameInput.value);
                updatePreviewAndInput(sku, true);
            });

            // generate button always generates and fills input
            genBtn.addEventListener('click', function(){
                const sku = generateSkuFromName(nameInput.value);
                updatePreviewAndInput(sku, true);
                autoChk.checked = true;
            });

            // if user types into SKU manually, turn off auto-generate
            skuInput.addEventListener('input', function(){
                if(skuInput.value && skuInput.value !== previewEl.textContent){
                    autoChk.checked = false;
                }
            });

            // initialize preview if empty
            document.addEventListener('DOMContentLoaded', function(){
                if(!previewEl.textContent || previewEl.textContent === '-'){
                    const initial = generateSkuFromName(nameInput.value || 'PRODUCT');
                    updatePreviewAndInput(initial, false);
                }
            });
        })();
    </script>

@endsection
