<nav x-data="{ open: false, searchOpen: false }" @click.outside="open = false" class="bg-white shadow-sm sticky top-0 z-50">

    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <span class="font-bold text-gray-800">
                    {{ $settings['nama_sekolah'] ?? 'SMK' }}
                </span>
            </div>

            <!-- Right -->
            <div class="flex items-center gap-2">

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('profil') }}">Profil</a>
                    <a href="{{ route('jurusan.index') }}">Jurusan</a>
                    <a href="{{ route('berita.index') }}">Berita</a>
                    <a href="{{ route('galeri') }}">Galeri</a>
                    <a href="{{ route('kelulusan.index') }}">Kelulusan</a>
                    <a href="{{ route('kontak') }}">Kontak</a>
                </div>

                <!-- Search -->
                <button @click="searchOpen = !searchOpen" class="p-2">
                    🔍
                </button>

                <!-- Hamburger -->
                <button @click="open = !open" class="md:hidden p-2 text-xl">
                    ☰
                </button>
            </div>
        </div>

        <!-- Search -->
        <div x-show="searchOpen" x-transition x-cloak class="pb-4">
            <input type="search" placeholder="Cari..." class="w-full px-4 py-2 border rounded-lg">
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" x-transition x-cloak class="md:hidden bg-white border-t shadow">

        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" @click="open=false" class="block py-2">Home</a>
            <a href="{{ route('profil') }}" @click="open=false" class="block py-2">Profil</a>
            <a href="{{ route('jurusan.index') }}" @click="open=false" class="block py-2">Jurusan</a>
            <a href="{{ route('berita.index') }}" @click="open=false" class="block py-2">Berita</a>
            <a href="{{ route('galeri') }}" @click="open=false" class="block py-2">Galeri</a>
            <a href="{{ route('kelulusan.index') }}" @click="open=false" class="block py-2 font-semibold">🎓
                Kelulusan</a>
            <a href="{{ route('kontak') }}" @click="open=false" class="block py-2">Kontak</a>
        </div>
    </div>
</nav>
