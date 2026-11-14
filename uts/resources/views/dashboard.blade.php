<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Dashboard Overview
            </h2>
            <span class="px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase bg-blue-100 text-blue-800 border border-blue-200 shadow-sm">
                Role: {{ auth()->user()->role }}
            </span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- ================= TAMPILAN OWNER ================= -->
@can('owner-only')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Omzet Bulanan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm font-semibold uppercase">Omzet Penjualan (Bulan Ini)</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($monthlySalesAmount) }}</p>
        </div>

        <!-- Card 2: Pengeluaran Bulanan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm font-semibold uppercase">Pengeluaran Stok (Bulan Ini)</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">Rp {{ number_format($monthlyPurchasesAmount) }}</p>
        </div>

        <!-- Card 3: Omzet All-Time -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm font-semibold uppercase">Total Omzet (All-Time)</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">Rp {{ number_format($totalAllTimeSales) }}</p>
        </div>
    </div>

    <!-- Card Estimasi Keuntungan (Dibuat Putih Solid & Jelas) -->
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-emerald-500">
        <h3 class="text-gray-500 text-sm font-semibold uppercase">Estimasi Keuntungan (Laba Bersih)</h3>
        <p class="text-3xl font-bold text-emerald-600 mt-2">
            Rp {{ number_format($monthlyProfit) }}
        </p>
        <p class="text-xs text-gray-400 mt-1">*Omzet Penjualan bulan ini dikurangi Pengeluaran Stok bulan ini</p>
    </div>
@endcan

            <!-- ================= TAMPILAN ADMIN ================= -->
            @if(auth()->user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Jenis Produk</p>
                                <h3 class="text-3xl font-black text-gray-800 mt-2">{{ $totalProducts }}</h3>
                            </div>
                            <div class="p-3 bg-gray-100 rounded-xl text-gray-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Transaksi Penjualan (Bulan Ini)</p>
                                <h3 class="text-3xl font-black text-indigo-600 mt-2">{{ $monthlySalesCount }} <span class="text-sm font-normal text-gray-500">Transaksi</span></h3>
                            </div>
                            <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Penerimaan Barang (Bulan Ini)</p>
                                <h3 class="text-3xl font-black text-blue-600 mt-2">{{ $monthlyPurchasesCount }} <span class="text-sm font-normal text-gray-500">Transaksi</span></h3>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ================= TAMPILAN STAFF ================= -->
            @if(auth()->user()->role === 'staff')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Penjualan Hari Ini</p>
                                <h3 class="text-3xl font-black text-emerald-600 mt-2">{{ $todaySalesCount }} <span class="text-sm font-normal text-gray-500">Transaksi</span></h3>
                            </div>
                            <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Jenis Produk di Gudang</p>
                                <h3 class="text-3xl font-black text-gray-800 mt-2">{{ $totalProducts }}</h3>
                            </div>
                            <div class="p-3 bg-gray-100 rounded-xl text-gray-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ================= PERINGATAN STOK MENIPIS ================= -->
            @if($lowStockProducts->count() > 0)
                <div class="bg-red-50 border border-red-200 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-red-100 text-red-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-red-800 text-base">Peringatan Stok Menipis!</h3>
                            <p class="text-xs text-red-600">Segera lalukan order pembelian ulang untuk produk di bawah ini:</p>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($lowStockProducts as $p)
                            <div class="bg-white p-3 rounded-xl border border-red-100 flex justify-between items-center shadow-2xs">
                                <span class="font-semibold text-sm text-gray-700 truncate">{{ $p->name }}</span>
                                <span class="px-2.5 py-1 text-xs font-extrabold bg-red-100 text-red-700 rounded-lg">
                                    Sisa: {{ $p->stock }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>