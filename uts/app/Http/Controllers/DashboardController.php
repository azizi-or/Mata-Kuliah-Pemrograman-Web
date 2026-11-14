<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Operasional (Staff & Admin)
        $totalProducts = Product::count();
        $todaySalesCount = Sale::whereDate('sold_at', today())->count();
        $monthlySalesCount = Sale::whereMonth('sold_at', now()->month)->whereYear('sold_at', now()->year)->count();
        $monthlyPurchasesCount = Purchase::whereMonth('purchased_at', now()->month)->whereYear('purchased_at', now()->year)->count();
        
        // Data Stok Menipis
        $lowStockProducts = Product::whereColumn('stock', '<=', 'minimum_stock')->get();

        // Data Keuangan Bulanan (Otomatis reset tiap ganti bulan)
        $monthlySalesAmount = Sale::whereMonth('sold_at', now()->month)
            ->whereYear('sold_at', now()->year)
            ->sum('total');

        $monthlyPurchasesAmount = Purchase::whereMonth('purchased_at', now()->month)
            ->whereYear('purchased_at', now()->year)
            ->sum('total');

        $monthlyProfit = $monthlySalesAmount - $monthlyPurchasesAmount;

        // Total Akumulasi Keseluruhan (All-Time)
        $totalAllTimeSales = Sale::sum('total');

        return view('dashboard', compact(
            'totalProducts', 
            'todaySalesCount', 
            'monthlySalesCount', 
            'monthlyPurchasesCount', 
            'lowStockProducts',
            'monthlySalesAmount',
            'monthlyPurchasesAmount',
            'monthlyProfit',
            'totalAllTimeSales'
        ));
    }
}