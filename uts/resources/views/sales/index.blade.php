<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Penjualan') }}
            </h2>
            <a href="{{ route('sales.create') }}" style="background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: bold; text-decoration: none;">
                + Transaksi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse border">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="p-3">No. Transaksi</th>
                            <th class="p-3">Kasir</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr class="border-b">
                            <td class="p-3 font-semibold">{{ $sale->sale_number }}</td>
                            <td class="p-3">{{ $sale->user->name }}</td>
                            <td class="p-3">{{ $sale->sold_at }}</td>
                            <td class="p-3 text-green-600 font-bold">Rp {{ number_format($sale->total) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-gray-500">Belum ada transaksi penjualan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>