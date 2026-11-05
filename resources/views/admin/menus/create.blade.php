<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Menu Baru') }}
            </h2>
            <a href="{{ route('menus.index') }}" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8">

                <!-- Tampilkan pesan error validasi umum jika ada -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                        <p class="font-bold">Terjadi kesalahan pada input data:</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nama Menu -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="Contoh: Kopi, Non-Kopi, Makanan, Camilan" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('category')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="500" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('price')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Menu</label>
                        <textarea name="description" id="description" rows="4" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            placeholder="Jelaskan komposisi atau keunggulan menu ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Menu -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Foto Menu</label>
                        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/webp" 
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</p>
                        @error('image')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('menus.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 shadow-sm transition">
                            Simpan Menu
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>