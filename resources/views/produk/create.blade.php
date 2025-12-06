<x-admin-layout>
    <x-slot name="title">Tambah Produk</x-slot>

    <div class="max-w-4xl mx-auto">
        <!-- Back Button & Header -->
        <div class="mb-6">
            <a href="/produk" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Produk
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h2>
            <p class="text-sm text-gray-600 mt-1">Lengkapi form di bawah untuk menambahkan produk baru ke inventori</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <form action="/produk/store" method="POST">
                @csrf
                
                <!-- Form Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 border-b">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Informasi Produk
                    </h3>
                </div>

                <!-- Form Body -->
                <div class="px-6 py-6 space-y-6">
                    <!-- Nama Produk -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan nama produk" value="{{ old('nama') }}">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori" name="kategori" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Pakaian" {{ old('kategori') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                            <option value="Makanan" {{ old('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Minuman" {{ old('kategori') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Alat Tulis" {{ old('kategori') == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ID Kategori (Hidden/Optional) -->
                    <input type="hidden" name="id_kategori" value="1">

                    <!-- Quantity -->
                    <div>
                        <label for="qty" class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="qty" name="qty" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('qty') border-red-500 @enderror"
                            placeholder="Masukkan jumlah stok" value="{{ old('qty') }}">
                        @error('qty')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga Beli & Harga Jual -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="harga_beli" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Beli <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="number" id="harga_beli" name="harga_beli" required min="0"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('harga_beli') border-red-500 @enderror"
                                    placeholder="0" value="{{ old('harga_beli') }}">
                            </div>
                            @error('harga_beli')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="harga_jual" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Jual <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="number" id="harga_jual" name="harga_jual" required min="0"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('harga_jual') border-red-500 @enderror"
                                    placeholder="0" value="{{ old('harga_jual') }}">
                            </div>
                            @error('harga_jual')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t flex items-center justify-end space-x-3">
                    <a href="/produk" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
