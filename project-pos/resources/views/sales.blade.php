@extends('layouts.app')
@section('title','Kasir - Mustika Komputer')
@section('header-title','Kasir')
@section('content')

    <div class="pos-layout">
            <div class="pos-products">
                <div class="form-group">
                    <input type="text" id="product_search" placeholder="Cari produk berdasarkan nama atau SKU...">
                </div>

                <div class="product-grid">
                    @foreach($products as $product)
                        <div class="product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->sale_price }}">
                            <h6>{{ $product->name }}</h6>
                            <span>Rp {{ number_format($product->sale_price,0,',','.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="pos-cart">
                <div class="pos-cart-header"><h3>Keranjang Belanja</h3></div>
                <div class="info-box"><p>Klik pada <b>Qty</b> atau <b>Harga</b> untuk mengubahnya (fitur tawar harga).</p></div>

                <ul class="cart-item-list" id="cart-items"></ul>

                <div class="cart-summary">
                    <div class="summary-row"><span>Subtotal</span><span id="subtotal_display">Rp 0</span></div>
                    <div class="summary-row"><span>Pajak (11%)</span><span id="tax_display">Rp 0</span></div>
                    <div class="summary-row total"><span>Total</span><span id="total_display">Rp 0</span></div>
                    <button type="button" id="process_payment_btn" class="cta-button" style="margin-top:1.5rem;"><i data-feather="check-circle"></i> Proses Pembayaran</button>
                </div>
            </aside>
    </div>

    <!-- Payment Modal (hidden by default) -->
    <div id="payment_modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Proses Pembayaran</h2>
            </div>
            <div class="modal-body">
                <div class="payment-info">
                    <label>Total Belanja</label>
                    <div id="modal_total_value" class="total-value">Rp 0</div>
                </div>

                <div class="payment-methods">
                    <label>Pilih Metode Pembayaran</label>
                    <div class="method-options" id="method_options">
                        <button type="button" data-method="cash" class="method-btn active">
                            <i data-feather="dollar-sign"></i>
                            Tunai
                        </button>
                        <button type="button" data-method="transfer" class="method-btn">
                            <i data-feather="repeat"></i>
                            Transfer
                        </button>
                    </div>
                </div>

                <div id="cash_section" class="cash-calculator">
                    <div class="form-group">
                        <label for="cash_received">Jumlah Uang Tunai (Rp)</label>
                        <input type="number" id="cash_received" name="cash_received" placeholder="Contoh: 1400000">
                    </div>
                    <div class="change-display">
                        <label>Kembalian</label>
                        <div id="change_value" class="change-value">Rp 0</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal_cancel_btn" class="secondary-button">Batal</button>
                <button type="button" id="modal_confirm_btn" class="cta-button"><i data-feather="check-circle"></i> Konfirmasi Pembayaran</button>
            </div>
        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function(){
    const productCards = Array.from(document.querySelectorAll('.product-card'));
    const cartItemsEl = document.getElementById('cart-items');
    const subtotalDisplay = document.getElementById('subtotal_display');
    const taxDisplay = document.getElementById('tax_display');
    const totalDisplay = document.getElementById('total_display');
    const processBtn = document.getElementById('process_payment_btn');
    const searchInput = document.getElementById('product_search');

    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let products = productCards.map(card => ({
        id: parseInt(card.dataset.id,10),
        name: card.dataset.name,
        price: parseFloat(card.dataset.price) || 0,
    }));

    let cart = [];

    function formatIDR(n){
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(n);
    }

    function findCartItem(productId){
        return cart.find(i => i.product_id === productId);
    }

    function addToCart(productId){
        const p = products.find(x => x.id === productId);
        if(!p) return;
        let item = findCartItem(productId);
        if(item) {
            item.quantity += 1;
        } else {
            cart.push({ product_id: p.id, name: p.name, price_per_unit: p.price, quantity: 1 });
        }
        renderCart();
    }

    function removeFromCart(productId){
        cart = cart.filter(i => i.product_id !== productId);
        renderCart();
    }

    function renderCart(){
        cartItemsEl.innerHTML = '';
        cart.forEach(it => {
            const li = document.createElement('li');
            li.className = 'cart-item';
            li.innerHTML = `
                <div class="cart-item-left">
                    <div class="cart-item-name">${it.name}</div>
                </div>
                <div class="cart-item-right">
                    <input type="number" min="1" class="cart-qty" data-id="${it.product_id}" value="${it.quantity}" style="width:5rem;margin-right:0.5rem;">
                    <input type="number" min="0" step="0.01" class="cart-price" data-id="${it.product_id}" value="${it.price_per_unit}" style="width:7rem;margin-right:0.5rem;">
                    <button class="remove-item" data-id="${it.product_id}" aria-label="Remove">&times;</button>
                </div>
            `;
            cartItemsEl.appendChild(li);
        });

        // bind events
        Array.from(document.querySelectorAll('.remove-item')).forEach(btn => {
            btn.addEventListener('click', e => {
                const id = parseInt(e.currentTarget.dataset.id,10);
                removeFromCart(id);
            });
        });

        Array.from(document.querySelectorAll('.cart-qty')).forEach(inp => {
            inp.addEventListener('change', e => {
                const id = parseInt(e.currentTarget.dataset.id,10);
                const val = parseInt(e.currentTarget.value,10) || 1;
                const it = findCartItem(id);
                if(it){ it.quantity = val; renderCart(); }
            });
        });

        Array.from(document.querySelectorAll('.cart-price')).forEach(inp => {
            inp.addEventListener('change', e => {
                const id = parseInt(e.currentTarget.dataset.id,10);
                const val = parseFloat(e.currentTarget.value) || 0;
                const it = findCartItem(id);
                if(it){ it.price_per_unit = val; renderCart(); }
            });
        });

        updateTotals();
    }

    function updateTotals(){
        const subtotal = cart.reduce((s,it) => s + (it.price_per_unit * it.quantity), 0);
        const tax = Math.round(subtotal * 0.11);
        const total = subtotal + tax;
        subtotalDisplay.textContent = formatIDR(subtotal);
        taxDisplay.textContent = formatIDR(tax);
        totalDisplay.textContent = formatIDR(total);
    }

    // attach add-to-cart handlers
    productCards.forEach(card => {
        card.addEventListener('click', () => addToCart(parseInt(card.dataset.id,10)));
    });

    // search filter
    if(searchInput){
        searchInput.addEventListener('input', e => {
            const q = e.target.value.toLowerCase();
            productCards.forEach(c => {
                const name = (c.dataset.name || '').toLowerCase();
                c.style.display = name.includes(q) ? '' : 'none';
            });
        });
    }

    // Open payment modal and populate totals
    const modal = document.getElementById('payment_modal');
    const modalTotal = document.getElementById('modal_total_value');
    const cashSection = document.getElementById('cash_section');
    const cashInput = document.getElementById('cash_received');
    const changeValue = document.getElementById('change_value');
    const methodButtons = Array.from(document.querySelectorAll('.method-btn'));
    const modalConfirmBtn = document.getElementById('modal_confirm_btn');
    const modalCancelBtn = document.getElementById('modal_cancel_btn');

    function openPaymentModal(){
        if(cart.length === 0){ alert('Keranjang kosong. Tambahkan produk terlebih dahulu.'); return; }
        const subtotal = cart.reduce((s,it) => s + (it.price_per_unit * it.quantity), 0);
        const tax = Math.round(subtotal * 0.11);
        const total = subtotal + tax;
        modalTotal.textContent = formatIDR(total);
        modal.dataset.total = total;
        cashInput.value = total;
        changeValue.textContent = formatIDR(0);
        // default to cash visible
        cashSection.classList.remove('hidden');
        modal.style.display = 'flex';
        if(window.feather) window.feather.replace();
    }

    function closePaymentModal(){
        modal.style.display = 'none';
    }

    // method selection
    methodButtons.forEach(btn => {
        btn.addEventListener('click', function(){
            methodButtons.forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');
            const m = btn.dataset.method;
            if(m === 'cash'){
                cashSection.classList.remove('hidden');
            } else {
                cashSection.classList.add('hidden');
            }
            if(window.feather) window.feather.replace();
        });
    });

    // compute change live
    cashInput.addEventListener('input', function(){
        const total = Number(modal.dataset.total || 0);
        const paid = Number(cashInput.value || 0);
        const ch = Math.max(0, Math.round(paid - total));
        changeValue.textContent = formatIDR(ch);
    });

    processBtn.addEventListener('click', function(){
        openPaymentModal();
    });

    modalCancelBtn.addEventListener('click', function(){
        closePaymentModal();
    });

    modalConfirmBtn.addEventListener('click', async function(){
        const methodBtn = document.querySelector('.method-btn.active');
        const payment_method = methodBtn ? methodBtn.dataset.method : 'cash';
        let cash_received = null;
        if(payment_method === 'cash'){
            cash_received = Number(cashInput.value || 0);
        }

        const payload = {
            payment_method,
            cash_received,
            items: cart.map(i => ({ product_id: i.product_id, quantity: i.quantity, price_per_unit: i.price_per_unit }))
        };

        try{
            modalConfirmBtn.disabled = true;
            modalConfirmBtn.textContent = 'Memproses...';
            const res = await fetch('/sales/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });
            const data = await res.json();
            if(res.ok){
                // show simple success modal then reload
                closePaymentModal();
                cart = [];
                renderCart();
                window.location.reload();
            } else {
                alert('Gagal memproses: ' + (data.message || 'Server error'));
            }
        } catch(err){
            alert('Terjadi kesalahan: ' + err.message);
        } finally {
            modalConfirmBtn.disabled = false;
            modalConfirmBtn.innerHTML = '<i data-feather="check-circle"></i> Konfirmasi Pembayaran';
            if(window.feather) window.feather.replace();
        }
    });

    renderCart();
});
</script>
