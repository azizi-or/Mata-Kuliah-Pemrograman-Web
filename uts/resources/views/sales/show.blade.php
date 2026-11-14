<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Penjualan</h2>
            <a href="{{ route('sales.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm rounded p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-700">
                    <div><span class="font-semibold">No. Penjualan:</span> {{ $sale->sale_number }}</div>
                    <div><span class="font-semibold">Kasir:</span> {{ $sale->user?->name ?? '-' }}</div>
                    <div><span class="font-semibold">Tanggal:</span> {{ $sale->sold_at?->format('d-m-Y H:i') }}</div>
                    <div><span class="font-semibold">Status:</span> {{ $sale->status }}</div>
                    <div><span class="font-semibold">Total:</span> Rp {{ number_format($sale->total, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded p-6">
                <h3 class="font-semibold text-lg mb-4">Item Penjualan</h3>
                <table class="w-full text-left border-collapse border">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="p-3">Produk</th>
                            <th class="p-3">Qty</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->items as $item)
                            <tr class="border-b">
                                <td class="p-3">{{ $item->product?->name ?? '-' }}</td>
                                <td class="p-3">{{ $item->quantity }}</td>
                                <td class="p-3">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td class="p-3">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">Belum ada item penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
