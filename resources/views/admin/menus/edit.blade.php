<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Menu</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
                <form action="{{ route('menus.update', $menu->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nama Menu</label>
                        <input type="text" name="name" value="{{ old('name', $menu->name) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $menu->category) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $menu->price) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Deskripsi</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $menu->description) }}</textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('menus.index') }}" class="px-4 py-2 bg-gray-300 rounded-md text-sm">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>