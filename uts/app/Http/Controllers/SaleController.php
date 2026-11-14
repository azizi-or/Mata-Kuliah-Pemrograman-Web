<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('user')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::lockForUpdate()->findOrFail($validated['product_id']);
            $qty = (int) $validated['quantity'];

            // Menolak jika stok di gudang tidak mencukupi (misal sisa 10 tapi dibeli 15)
            if ($product->stock < $qty) {
                throw ValidationException::withMessages([
                    'quantity' => "Transaksi Ditolak! Stok gudang '{$product->name}' hanya sisa {$product->stock}, tidak cukup untuk transaksi sejumlah {$qty}.",
                ]);
            }

            $subtotal = $product->selling_price * $qty;

            // 1. Catat Transaksi Penjualan
            $sale = Sale::create([
                'user_id'     => Auth::id(),
                'sale_number' => 'SL-' . date('YmdHis') . '-' . rand(100, 999),
                'total'       => $subtotal,
                'status'      => 'completed',
                'sold_at'     => now(),
            ]);

            // 2. Catat Detail Item
            $sale->items()->create([
                'product_id' => $product->id,
                'quantity'   => $qty,
                'unit_price' => $product->selling_price,
                'subtotal'   => $subtotal,
            ]);

            // 3. Kurangi Stok Gudang secara Otomatis
            $product->decrement('stock', $qty);
        });

        return redirect()->route('sales.index')->with('success', 'Transaksi penjualan berhasil disimpan dan stok gudang berkurang!');
    }
}