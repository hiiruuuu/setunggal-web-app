<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setunggal Indonesia - Ruang Santai & Kopi Pilihan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fdf8f6',
                            100: '#f2e8e5',
                            600: '#8B4513', // Warna cokelat tema kopi/klasik
                            700: '#6d3410',
                            800: '#52270c',
                        }
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-stone-50 text-stone-800 font-sans antialiased">

    <!-- HEADER / NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-xl">S</div>
                <span class="text-xl font-bold tracking-tight text-stone-900">Setunggal Indonesia</span>
            </div>
            <nav class="hidden md:flex space-x-8 font-medium text-stone-600">
                <a href="#beranda" class="hover:text-brand-600 transition">Beranda</a>
                <a href="#tentang" class="hover:text-brand-600 transition">Tentang Kami</a>
                <a href="#menu" class="hover:text-brand-600 transition">Menu Pilihan</a>
                <a href="#kontak" class="hover:text-brand-600 transition">Kontak & Lokasi</a>
            </nav>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/admin/menus') }}" class="text-stone-700 font-medium text-sm hover:text-brand-600 transition">Dashboard Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-stone-700 font-medium text-sm hover:text-brand-600 transition">Login Admin</a>
                @endauth
                <a href="#menu" class="bg-brand-600 text-white px-5 py-2.5 rounded-full font-medium text-sm hover:bg-brand-700 transition shadow-sm">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="relative bg-stone-900 text-white py-24 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-45 bg-[radial-gradient(#8B4513_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block bg-brand-600/30 text-brand-100 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-4 border border-brand-600/50">
                Selamat Datang di Setunggal
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6">
                Rasa Autentik, <span class="text-amber-500">Momen Bersama</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg text-stone-300 mb-8">
                Nikmati sajian kopi pilihan dan hidangan spesial yang diracik sepenuh hati untuk menemani waktu santai dan produktif Anda setiap hari.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#menu" class="bg-brand-600 hover:bg-brand-700 text-white font-medium px-6 py-3 rounded-full transition shadow-lg">
                    Lihat Menu Kami
                </a>
                <a href="#kontak" class="bg-white/10 hover:bg-white/20 text-white font-medium px-6 py-3 rounded-full transition border border-white/20">
                    Kunjungi Tempat
                </a>
            </div>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold tracking-tight text-stone-900">Cerita di Balik Setunggal Indonesia</h2>
                    <p class="text-stone-600 leading-relaxed">
                        Setunggal hadir sebagai wadah berkumpul yang mengutamakan kualitas rasa dan kehangatan suasana. Kami menyajikan racikan minuman dan makanan terbaik yang diolah dari bahan-bahan pilihan berkualitas tinggi.
                    </p>
                    <p class="text-stone-600 leading-relaxed">
                        Komitmen kami adalah memberikan pengalaman bersantai yang nyaman bagi setiap pengunjung, baik untuk bekerja, berdiskusi, maupun melepas penat.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-stone-100">
                        <div>
                            <h3 class="text-2xl font-bold text-brand-600">100%</h3>
                            <p class="text-sm text-stone-500">Bahan Berkualitas</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-brand-600">Nyaman</h3>
                            <p class="text-sm text-stone-500">Suasana Hangat</p>
                        </div>
                    </div>
                </div>
                <div class="bg-stone-200 rounded-2xl h-80 flex items-center justify-center text-stone-400 font-medium">
                    <span>[ Tempat untuk Asset Foto / Banner ]</span>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU UNGGULAN (DENGAN FILTER & GAMBAR DINAMIS) -->
    <section id="menu" class="py-20 bg-stone-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-3xl font-bold tracking-tight text-stone-900 mb-4">Menu Pilihan Favorit</h2>
                <p class="text-stone-600">Pilihan menu terbaik yang selalu menjadi incaran para pelanggan setia kami.</p>
            </div>
            
            <!-- FORM SEARCH & FILTER KATEGORI -->
            <div class="mb-12 max-w-xl mx-auto space-y-4">
                <form action="{{ url('/') }}#menu" method="GET" class="flex gap-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama menu..." 
                            class="w-full px-4 py-2.5 pl-10 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-600 bg-white text-sm">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-stone-400 text-sm"></i>
                    </div>
                    <button type="submit" class="bg-brand-600 text-white px-5 py-2.5 rounded-lg font-medium text-sm hover:bg-brand-700 transition">
                        Cari
                    </button>
                    @if(request('search') || request('category'))
                        <a href="{{ url('/') }}#menu" class="bg-stone-200 text-stone-700 px-4 py-2.5 rounded-lg font-medium text-sm hover:bg-stone-300 transition flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>

                <!-- TOMBOL KATEGORI -->
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ url('/' . (request('search') ? '?search='.request('search') : '')) }}#menu" 
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-brand-600 text-white shadow-sm' : 'bg-white text-stone-600 border border-stone-200 hover:bg-stone-50' }}">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ url('/?category=' . urlencode($cat) . (request('search') ? '&search='.request('search') : '')) }}#menu" 
                           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ request('category') == $cat ? 'bg-brand-600 text-white shadow-sm' : 'bg-white text-stone-600 border border-stone-200 hover:bg-stone-50' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- GRID DAFTAR MENU -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($menus as $menu)
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="h-48 w-full object-cover">
                            @else
                                <div class="h-48 bg-stone-200 flex items-center justify-center text-stone-400 font-medium">
                                    <i class="fa-solid fa-utensils text-2xl mr-2"></i> [ Foto Produk ]
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex justify-between items-baseline mb-2">
                                    <h3 class="font-bold text-lg text-stone-900">{{ $menu->name }}</h3>
                                    <span class="text-brand-600 font-semibold text-sm">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-stone-600 text-sm mb-4 leading-relaxed">{{ $menu->description ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-0">
                            <span class="inline-block bg-stone-100 text-stone-600 text-xs px-2.5 py-1 rounded-full font-medium">
                                {{ $menu->category }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-xl shadow-sm">
                        <i class="fa-solid fa-mug-hot text-4xl text-stone-300 mb-3"></i>
                        <p class="text-stone-500 font-medium">Tidak ada menu yang sesuai dengan kriteria pencarian.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- KONTAK & LOKASI -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-stone-900 text-white rounded-2xl p-8 lg:p-12 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold tracking-tight">Kunjungi & Hubungi Kami</h2>
                    <p class="text-stone-300">
                        Mari mampir dan nikmati suasana langsung di kedai kami, atau hubungi melalui kanal media sosial di bawah ini.
                    </p>
                    <div class="space-y-4 text-stone-300 text-sm">
                        <p class="flex items-center space-x-3"><i class="fa-solid fa-location-dot text-brand-600 text-lg"></i> <span>Ngimbang, Lamongan, Jawa Timur</span></p>
                        <p class="flex items-center space-x-3"><i class="fa-solid fa-clock text-brand-600 text-lg"></i> <span>Buka Setiap Hari: 15.00 - 23.00 WIB</span></p>
                        <p class="flex items-center space-x-3"><i class="fa-solid fa-phone text-brand-600 text-lg"></i> <span>+62 851-6280-1281</span></p>
                    </div>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-brand-600 rounded-full flex items-center justify-center transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-brand-600 rounded-full flex items-center justify-center transition"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="bg-stone-800 rounded-xl p-6 text-center text-stone-400 h-64 flex flex-col items-center justify-center">
                    <i class="fa-solid fa-map-location-dot text-4xl mb-3 text-stone-500"></i>
                    <span>[ Integrasikan Google Maps Embed Di Sini ]</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-stone-950 text-stone-400 py-8 border-t border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-sm">
            <p>&copy; 2026 Setunggal Indonesia. Hak Cipta Dilindungi.</p>
            <p class="mt-4 sm:mt-0">Dibangun dengan antusias untuk pengalaman digital terbaik.</p>
        </div>
    </footer>

</body>
</html>