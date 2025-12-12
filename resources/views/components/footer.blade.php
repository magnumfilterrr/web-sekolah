<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-10">
        <!-- Kolom 1: Tentang -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Tentang Sekolah</h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                {{ $settings['nama_sekolah'] ?? 'SMK' }} adalah sekolah kejuruan yang berfokus pada pembentukan
                karakter, keterampilan, dan profesionalisme siswa.
            </p>
        </div>

        <!-- Kolom 2: Navigasi -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Navigasi Cepat</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                <li><a href="{{ route('profil') }}" class="hover:text-white">Profil</a></li>
                <li><a href="{{ route('jurusan.index') }}" class="hover:text-white">Jurusan</a></li>
                <li><a href="{{ route('berita.index') }}" class="hover:text-white">Berita</a></li>
                <li><a href="{{ route('galeri') }}" class="hover:text-white">Galeri</a></li>
                <li><a href="{{ route('kontak') }}" class="hover:text-white">Kontak</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Kontak -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Hubungi Kami</h3>
            <ul class="space-y-2 text-sm">
                <li>📍 {{ $settings['alamat'] ?? 'Alamat Sekolah' }}</li>
                <li>📞 {{ $settings['telepon'] ?? '08xxxxxxxxxx' }}</li>
                <li>✉️ {{ $settings['email'] ?? 'info@smk.sch.id' }}</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-gray-700 py-4 text-center text-sm text-gray-400">
        © {{ date('Y') }} {{ $settings['nama_sekolah'] ?? 'SMK' }}. All rights reserved.
    </div>
</footer>
