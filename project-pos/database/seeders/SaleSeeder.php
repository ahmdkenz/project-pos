<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $this->command->error('No user found. Please seed users first.');
            return;
        }

        $products = Product::all();
        if ($products->count() < 2) {
            $this->command->error('Need at least 2 products. Please seed products first.');
            return;
        }

        // Sale 1 - Hari ini
        $sale1 = Sale::create([
            'user_id' => $user->id,
            'total_amount' => 1354200,
            'payment_method' => 'Tunai',
            'created_at' => Carbon::now()->subMinutes(30),
        ]);

        SaleItem::create([
            'sale_id' => $sale1->id,
            'product_id' => $products[0]->id,
            'quantity' => 1,
            'price_per_unit' => 420000,
            'cost_price_per_unit' => $products[0]->cost_price ?? 350000,
        ]);

        SaleItem::create([
            'sale_id' => $sale1->id,
            'product_id' => $products[1]->id,
            'quantity' => 1,
            'price_per_unit' => 800000,
            'cost_price_per_unit' => $products[1]->cost_price ?? 650000,
        ]);

        // Sale 2 - Hari ini
        $sale2 = Sale::create([
            'user_id' => $user->id,
            'total_amount' => 1100000,
            'payment_method' => 'Transfer',
            'created_at' => Carbon::now()->subHours(2),
        ]);

        SaleItem::create([
            'sale_id' => $sale2->id,
            'product_id' => $products[0]->id,
            'quantity' => 2,
            'price_per_unit' => 420000,
            'cost_price_per_unit' => $products[0]->cost_price ?? 350000,
        ]);

        SaleItem::create([
            'sale_id' => $sale2->id,
            'product_id' => $products[1]->id,
            'quantity' => 1,
            'price_per_unit' => 260000,
            'cost_price_per_unit' => $products[1]->cost_price ?? 200000,
        ]);

        // Sale 3 - Kemarin
        $sale3 = Sale::create([
            'user_id' => $user->id,
            'total_amount' => 5500000,
            'payment_method' => 'Transfer',
            'created_at' => Carbon::yesterday()->setHour(16)->setMinute(15),
        ]);

        SaleItem::create([
            'sale_id' => $sale3->id,
            'product_id' => $products[0]->id,
            'quantity' => 5,
            'price_per_unit' => 420000,
            'cost_price_per_unit' => $products[0]->cost_price ?? 350000,
        ]);

        SaleItem::create([
            'sale_id' => $sale3->id,
            'product_id' => $products[1]->id,
            'quantity' => 4,
            'price_per_unit' => 900000,
            'cost_price_per_unit' => $products[1]->cost_price ?? 750000,
        ]);

        $this->command->info('✓ Sales seeded successfully!');
    }
}
