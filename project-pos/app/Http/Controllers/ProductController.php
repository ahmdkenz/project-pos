<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseLot;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('inventory', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'sku' => ['nullable','string','max:100','unique:products,sku'],
            'initial_stock' => ['nullable','integer','min:0'],
            'cost_price' => ['nullable','numeric','min:0'],
            'sale_price' => ['nullable','numeric','min:0'],
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'sku' => $data['sku'] ?? null,
            'current_stock' => $data['initial_stock'] ?? 0,
            'cost_price' => $data['cost_price'] ?? 0,
            'sale_price' => $data['sale_price'] ?? 0,
            'min_stock_level' => 0,
        ]);

        return redirect()->route('inventory')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function restock(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','integer','exists:products,id'],
            'quantity' => ['required','integer','min:1'],
            'cost_price' => ['required','numeric','min:0'],
        ]);

        $product = Product::find($data['product_id']);
        if(!$product){
            return redirect()->back()->with('error','Produk tidak ditemukan.');
        }

        // create purchase lot
        $lot = PurchaseLot::create([
            'product_id' => $product->id,
            'quantity_received' => $data['quantity'],
            'quantity_remaining' => $data['quantity'],
            'cost_price_per_unit' => $data['cost_price'],
        ]);

        // increment product stock
        $product->increment('current_stock', $data['quantity']);

        // record stock movement
        StockMovement::create([
            'product_id' => $product->id,
            'quantity' => $data['quantity'],
            'reason' => 'stock_in',
        ]);

        return redirect()->route('inventory')->with('status', 'Stok berhasil ditambahkan.');
    }
}
