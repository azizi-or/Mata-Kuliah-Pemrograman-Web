<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Pilih Produk</label>
                        <select name="product_id" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} — (Stok: {{ $product->stock }} | Harga: Rp {{ number_format($product->selling_price) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Jumlah (Qty)</label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('sales.index') }}" class="text-gray-600 hover:underline">Batal</a>
                        <button type="submit" style="background-color: #2563eb; color: #ffffff; padding: 8px 20px; border-radius: 6px; font-weight: bold;">
                            Simpan Transaksi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>