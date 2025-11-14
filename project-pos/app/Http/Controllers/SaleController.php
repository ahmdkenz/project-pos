<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('sales', compact('products'));
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'payment_method' => ['required','string'],
            'cash_received' => ['nullable','numeric','min:0'],
            'items' => ['required','array','min:1'],
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($data['items'] as $it) {
                $total += ($it['price_per_unit'] * $it['quantity']);
            }

            $sale = Sale::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'payment_method' => $data['payment_method'],
            ]);

            foreach ($data['items'] as $it) {
                $product = Product::find($it['product_id']);
                $cost = $product ? $product->cost_price : 0;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $it['product_id'],
                    'quantity' => $it['quantity'],
                    'price_per_unit' => $it['price_per_unit'],
                    'cost_price_per_unit' => $cost,
                ]);

                if ($product) {
                    // decrement stock
                    $product->decrement('current_stock', $it['quantity']);
                    // create stock movement
                    StockMovement::create([
                        'product_id' => $product->id,
                        'quantity' => -abs($it['quantity']),
                        'reason' => 'sale',
                    ]);
                }
            }

            DB::commit();
            return response()->json(['status' => 'success', 'sale_id' => $sale->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
