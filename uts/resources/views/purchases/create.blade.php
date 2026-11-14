<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catat Pembelian Baru (Barang Masuk Gudang)') }}
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

                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Pilih Supplier</label>
                        <select name="supplier_id" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Pilih Produk</label>
                        <select id="product_select" name="product_id" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                            <option value="" data-cost="0">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                {{-- Kita simpan harga beli default di attribute data-cost --}}
                                <option value="{{ $product->id }}" data-cost="{{ $product->purchase_price }}">
                                    {{ $product->name }} — (Stok Gudang Sekarang: {{ $product->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Jumlah Barang Masuk (Qty)</label>
                            <input type="number" name="quantity" min="1" value="1" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Harga Beli per Unit (Rp)</label>
                            <input type="number" id="unit_cost_input" name="unit_cost" min="0" placeholder="Otomatis terisi saat produk dipilih" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('purchases.index') }}" class="text-gray-600 hover:underline">Batal</a>
                        <button type="submit" style="background-color: #2563eb; color: #ffffff; padding: 8px 20px; border-radius: 6px; font-weight: bold;">
                            Simpan Pembelian & Tambah Stok
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Script untuk mengisi harga beli otomatis --}}
    <script>
        document.getElementById('product_select').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var purchaseCost = selectedOption.getAttribute('data-cost');
            document.getElementById('unit_cost_input').value = purchaseCost ? purchaseCost : '';
        });
    </script>
</x-app-layout>