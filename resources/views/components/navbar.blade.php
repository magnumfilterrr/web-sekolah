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

            <!-- Kanan: Menu + Tombol Search + Mobile -->
            <div class="flex items-center space-x-4">
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 font-medium">
                    <a href="{{ route('home') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700' }}">
                        Home
                    </a>
                    <a href="{{ route('profil') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('profil') ? 'text-blue-600' : 'text-gray-700' }}">
                        Profil
                    </a>
                    <a href="{{ route('jurusan.index') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('jurusan.*') ? 'text-blue-600' : 'text-gray-700' }}">
                        Jurusan
                    </a>
                    <a href="{{ route('berita.index') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('berita.*') ? 'text-blue-600' : 'text-gray-700' }}">
                        Berita
                    </a>
                    <a href="{{ route('galeri') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('galeri') ? 'text-blue-600' : 'text-gray-700' }}">
                        Galeri
                    </a>
                    <a href="{{ route('kelulusan.index') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('kelulusan.*') ? 'text-blue-600' : 'text-gray-700' }}">
                        Kelulusan
                    </a>
                    <a href="{{ route('kontak') }}"
                        class="hover:text-blue-600 transition {{ request()->routeIs('kontak') ? 'text-blue-600' : 'text-gray-700' }}">
                        Kontak
                    </a>
                </div>

                <!-- Tombol Search + Mobile -->
                <div class="flex items-center gap-2">
                    <button @click="searchOpen = !searchOpen"
                        class="p-2 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <button @click="open = !open" class="md:hidden p-2 text-gray-700 focus:outline-none">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>


        <!-- Search Bar (Expandable) -->
        <div x-show="searchOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="pb-4">
            <form action="{{ route('search') }}" method="GET" class="relative max-w-md ml-auto">
                <input type="search" name="q" placeholder="Cari berita atau jurusan..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required minlength="3" />
                <button type="submit" class="absolute right-3 top-2.5 text-gray-500 hover:text-blue-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Offcanvas Menu -->
    <div x-show="open" x-transition:enter="transition transform duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" x-cloak
        class="fixed inset-y-0 right-0 w-72 bg-white shadow-xl z-50 md:hidden">
        <!-- Header -->
        <div class="flex items-center justify-between px-4 h-16 border-b">
            <span class="font-bold text-gray-800">Menu</span>
            <button @click="open = false" class="text-gray-700">
                ✕
            </button>
        </div>

        <!-- Menu -->
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600">Home</a>
            <a href="{{ route('profil') }}" class="block py-2 text-gray-700 hover:text-blue-600">Profil</a>
            <a href="{{ route('jurusan.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Jurusan</a>
            <a href="{{ route('berita.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Berita</a>
            <a href="{{ route('galeri') }}" class="block py-2 text-gray-700 hover:text-blue-600">Galeri</a>
            <a href="{{ route('kelulusan.index') }}"
                class="block py-2 text-gray-700 hover:text-blue-600 font-semibold">
                🎓 Kelulusan
            </a>
            <a href="{{ route('kontak') }}" class="block py-2 text-gray-700 hover:text-blue-600">Kontak</a>
        </div>
    </div>

</nav>
