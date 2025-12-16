<nav x-data="{ open: false, searchOpen: false }" class="bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center px-4">
            <!-- Kiri: Logo + Nama Sekolah -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-md object-contain">
                <a href="{{ route('home') }}" class="text-lg font-bold text-gray-800 hover:text-blue-600 transition">
                    {{ $settings['nama_sekolah'] ?? 'SMK' }}
                </a>
            </div>

            <!-- Kanan -->
            <div class="flex items-center space-x-4">
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 font-medium">
                    <a href="{{ route('home') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700' }}">Home</a>
                    <a href="{{ route('profil') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('profil') ? 'text-blue-600' : 'text-gray-700' }}">Profil</a>
                    <a href="{{ route('jurusan.index') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('jurusan.*') ? 'text-blue-600' : 'text-gray-700' }}">Jurusan</a>
                    <a href="{{ route('berita.index') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('berita.*') ? 'text-blue-600' : 'text-gray-700' }}">Berita</a>
                    <a href="{{ route('galeri') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('galeri') ? 'text-blue-600' : 'text-gray-700' }}">Galeri</a>
                    <a href="{{ route('kelulusan.index') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('kelulusan.*') ? 'text-blue-600' : 'text-gray-700' }}">Kelulusan</a>
                    <a href="{{ route('kontak') }}"
                        class="hover:text-blue-600 {{ request()->routeIs('kontak') ? 'text-blue-600' : 'text-gray-700' }}">Kontak</a>
                </div>

                <!-- Search & Hamburger -->
                <div class="flex items-center gap-2">
                    <button @click="searchOpen = !searchOpen" class="p-2 text-gray-700 hover:text-blue-600">
                        🔍
                    </button>

                    <button @click="open = true" class="md:hidden p-2 text-gray-700">
                        ☰
                    </button>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div x-show="searchOpen" x-transition class="pb-4">
            <form action="{{ route('search') }}" method="GET" class="relative max-w-md ml-auto">
                <input type="search" name="q" placeholder="Cari berita atau jurusan..."
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required minlength="3">
            </form>
        </div>
    </div>

    <!-- ✅ OVERLAY (HARUS DI ATAS KONTEN, DI BAWAH MENU) -->
    <div x-show="open" x-transition.opacity x-cloak @click="open = false"
        class="fixed inset-0 bg-black/40 z-40 md:hidden">
    </div>

    <!-- ✅ OFFCANVAS MENU -->
    <div x-show="open" x-transition:enter="transition transform duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" x-cloak
        class="fixed inset-y-0 right-0 w-72 bg-white shadow-xl z-50 md:hidden pointer-events-auto">
        <!-- Header -->
        <div class="flex items-center justify-between px-4 h-16 border-b">
            <span class="font-bold text-gray-800">Menu</span>
            <button @click="open = false" class="text-2xl font-bold text-gray-700">
                ✕
            </button>
        </div>

        <!-- Menu -->
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block py-2">Home</a>
            <a href="{{ route('profil') }}" class="block py-2">Profil</a>
            <a href="{{ route('jurusan.index') }}" class="block py-2">Jurusan</a>
            <a href="{{ route('berita.index') }}" class="block py-2">Berita</a>
            <a href="{{ route('galeri') }}" class="block py-2">Galeri</a>
            <a href="{{ route('kelulusan.index') }}" class="block py-2 font-semibold">🎓 Kelulusan</a>
            <a href="{{ route('kontak') }}" class="block py-2">Kontak</a>
        </div>
    </div>
</nav>
