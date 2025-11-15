@extends('layouts.app')

@section('title','Manajemen Produk - Mustika Komputer')
@section('header-title','Manajemen Produk')

@section('content')

    <div class="page-header">
        <div class="search-container" style="flex: 1; max-width: 500px;">
            <form method="GET" action="{{ route('inventory') }}" id="searchForm">
                <div style="position: relative;">
                    <i data-feather="search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #718096; width: 18px; height: 18px;"></i>
                    <input 
                        type="text" 
                        name="q" 
                        id="product-search" 
                        value="{{ $searchQuery ?? '' }}" 
                        placeholder="Cari nama produk atau SKU..." 
                        autocomplete="off"
                        style="width: 100%; padding: 0.75rem 1rem 0.75rem 3rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.95rem; font-family: 'Poppins', sans-serif;"
                    />
                    <ul id="autocomplete-list" class="autocomplete-suggestions" style="display: none;"></ul>
                </div>
            </form>
        </div>
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
                    <td class="stock-level {{ $product->current_stock <= ($product->min_stock_level ?? 0) ? 'low' : '' }}">
                        {{ $product->current_stock }}
                        @if($product->current_stock <= 0)
                            <span class="badge badge-danger" style="margin-left:0.5rem;">Habis</span>
                        @elseif($product->current_stock < 3)
                            <span class="badge badge-warning" style="margin-left:0.5rem;">Menipis</span>
                        @endif
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('products.edit', $product->id) }}" title="Edit"><i data-feather="edit-2"></i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('⚠️ PERINGATAN!\n\nAnda yakin ingin menghapus produk \"{{ $product->name }}\" ({{ $product->sku }})?\n\nCatatan: Produk yang sudah pernah dijual tidak dapat dihapus untuk menjaga integritas data transaksi.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" style="background:none;border:none;padding:0;margin:0;vertical-align:middle;color:inherit;">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($products->hasPages())
        <div style="margin-top: 2rem;">
            {{ $products->links() }}
        </div>
        @endif
    </div>

    <div class="page-header" style="margin-top: 2rem;">
        <h1>Barang Masuk / Restock</h1>
    </div>
    
    <div class="content-card">
        <form action="{{ route('inventory.restock') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="product">Pilih Produk</label>
                <select id="product" name="product_id" required>
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

@push('styles')
<style>
    .autocomplete-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .autocomplete-suggestions li {
        padding: 0.75rem 1rem;
        cursor: pointer;
        border-bottom: 1px solid #f4f7fa;
        font-size: 0.9rem;
        color: #2d3748;
        transition: background-color 0.2s;
    }
    
    .autocomplete-suggestions li:last-child {
        border-bottom: none;
    }
    
    .autocomplete-suggestions li:hover,
    .autocomplete-suggestions li.active {
        background-color: #eef2ff;
        color: #4F46E5;
    }

    /* Pagination styling sudah ada di layout global - tidak perlu duplikat */

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('product-search');
    const autocompleteList = document.getElementById('autocomplete-list');
    const searchForm = document.getElementById('searchForm');
    let debounceTimer = null;
    let currentFocus = -1;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            
            if (!query || query.length < 2) {
                autocompleteList.style.display = 'none';
                autocompleteList.innerHTML = '';
                return;
            }
            
            debounceTimer = setTimeout(() => {
                fetch(`{{ route('inventory') }}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    autocompleteList.innerHTML = '';
                    currentFocus = -1;
                    
                    if (!data || data.length === 0) {
                        autocompleteList.style.display = 'none';
                        return;
                    }
                    
                    data.forEach((item, index) => {
                        const li = document.createElement('li');
                        li.textContent = item.label;
                        li.setAttribute('data-value', item.value);
                        li.addEventListener('click', function() {
                            searchInput.value = this.getAttribute('data-value');
                            autocompleteList.style.display = 'none';
                            searchForm.submit();
                        });
                        autocompleteList.appendChild(li);
                    });
                    
                    autocompleteList.style.display = 'block';
                })
                .catch(error => {
                    console.error('Autocomplete error:', error);
                    autocompleteList.style.display = 'none';
                });
            }, 300);
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const items = autocompleteList.getElementsByTagName('li');
            
            if (e.keyCode === 40) { // Arrow Down
                e.preventDefault();
                currentFocus++;
                addActive(items);
            } else if (e.keyCode === 38) { // Arrow Up
                e.preventDefault();
                currentFocus--;
                addActive(items);
            } else if (e.keyCode === 13) { // Enter
                if (currentFocus > -1 && items[currentFocus]) {
                    e.preventDefault();
                    items[currentFocus].click();
                }
            } else if (e.keyCode === 27) { // Escape
                autocompleteList.style.display = 'none';
            }
        });

        function addActive(items) {
            if (!items || items.length === 0) return false;
            removeActive(items);
            if (currentFocus >= items.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = items.length - 1;
            items[currentFocus].classList.add('active');
        }

        function removeActive(items) {
            for (let i = 0; i < items.length; i++) {
                items[i].classList.remove('active');
            }
        }

        // Close autocomplete when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target !== searchInput) {
                autocompleteList.style.display = 'none';
            }
        });
    }
});
</script>
@endpush
