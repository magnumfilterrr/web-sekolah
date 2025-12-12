@extends('layouts.app')

@section('title', 'Profil Sekolah')

@section('content')
    <x-frontend.hero-section title="Profil Sekolah" subtitle="Mengenal Lebih Dekat SMKS Nuurul Muttaqin Cisurupan" />

    <!-- Tentang Sekolah -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 relative z-10">

            <!-- Tentang Sekolah -->
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang Sekolah</h2>
                <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    SMKS Nuurul Muttaqin Cisurupan adalah sekolah kejuruan yang berfokus pada pengembangan keterampilan
                    siswa agar siap menghadapi dunia kerja.
                    Dengan tenaga pendidik profesional, fasilitas lengkap, dan lingkungan belajar yang inspiratif, kami
                    berkomitmen melahirkan generasi produktif, kreatif, dan inovatif.
                </p>
            </div>

            <!-- Visi dan Misi -->
            <div class="grid md:grid-cols-2 gap-10 mb-20">
                <div
                    class="bg-white shadow-md rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi SMK unggul yang menghasilkan lulusan berkompeten, berkarakter, dan siap bersaing di era
                        digital.
                    </p>
                </div>

                <div
                    class="bg-white shadow-md rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi</h3>
                    <ul class="list-decimal list-inside text-gray-700 space-y-2">
                        <li>Menyelenggarakan pendidikan kejuruan yang berkualitas.</li>
                        <li>Mengembangkan keterampilan siswa sesuai kebutuhan industri.</li>
                        <li>Membentuk karakter siswa yang berakhlak mulia.</li>
                        <li>Membangun kemitraan dengan dunia usaha dan industri.</li>
                    </ul>
                </div>
            </div>

            <!-- Fasilitas Sekolah -->
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Fasilitas Sekolah</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Sarana dan prasarana terbaik untuk mendukung proses belajar yang nyaman dan produktif.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($fasilitas as $item)
                    <div
                        class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden">
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_fasilitas }}"
                                class="h-full w-full object-cover transform hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->nama_fasilitas }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty state jika belum ada fasilitas -->
            @if ($fasilitas->isEmpty())
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Fasilitas</h3>
                    <p class="text-gray-600">Data fasilitas akan segera ditambahkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
