<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
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
}
