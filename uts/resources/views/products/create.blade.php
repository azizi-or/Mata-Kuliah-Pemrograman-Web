<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
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

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kode SKU</label>
                            <input type="text" name="sku" placeholder="Contoh: PRD-003" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                            <input type="text" name="name" placeholder="Nama Barang" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Harga Beli (Rp)</label>
                            <input type="number" name="purchase_price" min="0" placeholder="50000" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Harga Jual (Rp)</label>
                            <input type="number" name="selling_price" min="0" placeholder="85000" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Stok Awal</label>
                            <input type="number" name="stock" min="0" value="0" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Batas Minimum Stok</label>
                            <input type="number" name="minimum_stock" min="0" value="5" class="w-full border-gray-300 rounded-md shadow-sm p-2 border" required>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Batal</a>
                        <button type="submit" style="background-color: #2563eb; color: #ffffff; padding: 8px 20px; border-radius: 6px; font-weight: bold;">
                            Simpan Produk
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>