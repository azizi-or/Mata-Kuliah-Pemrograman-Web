<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'user'])->latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'unit_cost'   => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::lockForUpdate()->findOrFail($validated['product_id']);
            $qty = (int) $validated['quantity'];
            $unitCost = (float) $validated['unit_cost'];
            $subtotal = $unitCost * $qty;

            // 1. Buat Header Pembelian
            $purchase = Purchase::create([
                'supplier_id'     => $validated['supplier_id'],
                'user_id'         => Auth::id(),
                'purchase_number' => 'PO-' . date('YmdHis') . '-' . rand(100, 999),
                'total'           => $subtotal,
                'status'          => 'completed',
                'purchased_at'    => now(),
            ]);

            // 2. Buat Item Pembelian
            $purchase->items()->create([
                'product_id' => $product->id,
                'quantity'   => $qty,
                'unit_cost'  => $unitCost,
                'subtotal'   => $subtotal,
            ]);

            // 3. Tambahkan Stok Produk di Gudang
            $product->increment('stock', $qty);
        });

        return redirect()->route('purchases.index')->with('success', 'Pembelian berhasil dicatat dan stok gudang bertambah!');
    }
}