<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Produk') }}
            </h2>
            @can('admin-access')
                <a href="{{ route('products.create') }}" style="background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: bold; text-decoration: none;">
                    + Tambah Produk
                </a>
            @endcan
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
                            <th class="p-3">SKU</th>
                            <th class="p-3">Nama Produk</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Harga Beli</th>
                            <th class="p-3">Harga Jual</th>
                            <th class="p-3">Stok</th>
                            <th class="p-3">Min. Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-b">
                                <td class="p-3 font-mono text-sm">{{ $product->sku }}</td>
                                <td class="p-3 font-semibold">{{ $product->name }}</td>
                                <td class="p-3">{{ $product->category->name ?? '-' }}</td>
                                <td class="p-3">Rp {{ number_format($product->purchase_price) }}</td>
                                <td class="p-3 text-green-600 font-bold">Rp {{ number_format($product->selling_price) }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-sm font-bold {{ $product->stock <= $product->minimum_stock ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="p-3 text-gray-500">{{ $product->minimum_stock }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-3 text-center text-gray-500">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>