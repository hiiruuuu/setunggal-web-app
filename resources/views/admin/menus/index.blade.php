<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Menu Setunggal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan Sukses (Flash Message) -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Header Card dengan Tombol Berwarna Hitam/Gelap Menggunakan Inline Style -->
                <div class="flex flex-row justify-between items-center w-full mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Daftar Menu Makanan & Minuman</h3>
                        <p class="text-sm text-gray-500">Kelola ketersediaan, harga, dan informasi menu Setunggal.</p>
                    </div>
                    
                    <!-- Tombol Tambah Menu dengan Inline Style agar warnanya pasti muncul -->
                    <a href="{{ route('menus.create') }}" style="background-color: #111827; color: #ffffff;" class="inline-flex items-center justify-center px-4 py-2 rounded-md text-sm font-semibold hover:bg-gray-800 transition shadow-sm shrink-0">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Menu
                    </a>
                </div>

                <!-- Tabel Data Menu -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-gray-700 text-sm">
                                <th class="p-3">Foto</th>
                                <th class="p-3">Nama Menu</th>
                                <th class="p-3">Kategori</th>
                                <th class="p-3">Harga</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                            @forelse($menus as $menu)
                                <tr class="hover:bg-gray-50">
                                    <!-- Kolom Foto -->
                                    <td class="p-3">
                                        @if($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-12 h-12 object-cover rounded-md shadow-sm">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-md text-gray-400 flex items-center justify-center text-[10px] font-medium border border-gray-200">
                                                No Photo
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Kolom Nama Menu -->
                                    <td class="p-3 font-medium text-gray-900">{{ $menu->name }}</td>

                                    <!-- Kolom Kategori -->
                                    <td class="p-3">
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                            {{ $menu->category }}
                                        </span>
                                    </td>

                                    <!-- Kolom Harga -->
                                    <td class="p-3 font-semibold text-gray-900">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </td>

                                    <!-- Kolom Status Toggle (Ready / Habis) -->
                                    <td class="p-3">
                                        <form action="{{ route('menus.toggle', $menu->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3 py-1 text-xs rounded-full font-semibold transition {{ $menu->is_available ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                                {{ $menu->is_available ? 'Ready' : 'Habis' }}
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Kolom Aksi (Edit & Hapus) -->
                                    <td class="p-3">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('menus.edit', $menu->id) }}" class="text-amber-600 hover:text-amber-800 font-medium text-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
                                            <p class="text-base font-medium text-gray-700">Belum ada data menu tersimpan.</p>
                                            <p class="text-xs text-gray-400">Silakan klik tombol "Tambah Menu" di atas untuk mulai memasukkan menu pertama.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>