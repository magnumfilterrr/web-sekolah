@extends('layouts.app')

@section('title', 'Hasil Pencarian: ' . $query)

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Hasil Pencarian
                </h1>
                <p class="text-xl text-blue-100 mb-6">
                    Menampilkan hasil untuk: <span class="font-semibold">"{{ $query }}"</span>
                </p>
                <p class="text-lg text-blue-200">
                    Ditemukan <span class="font-bold">{{ $beritas->count() + $jurusans->count() }}</span> hasil
                </p>
            </div>
        </div>
    </section>

    <!-- Search Results Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-m mx-auto px-4">

            @if ($beritas->isEmpty() && $jurusans->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="mb-6">
                        <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        Tidak Ada Hasil Ditemukan
                    </h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Maaf, pencarian untuk "<span class="font-semibold">{{ $query }}</span>" tidak menemukan hasil
                        apapun.
                        Silakan coba kata kunci lain.
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            @else
                <!-- Filter Tabs (Sticky) -->
                <div class="sticky top-16 z-30 bg-white shadow-md rounded-lg mb-8" data-aos="fade-down">
                    <div class="flex justify-center gap-4 p-4">
                        <button onclick="filterResults('semua')"
                            class="filter-btn px-6 py-2 rounded-lg font-semibold transition-all active" data-filter="semua">
                            Semua ({{ $beritas->count() + $jurusans->count() }})
                        </button>
                        @if ($beritas->isNotEmpty())
                            <button onclick="filterResults('berita')"
                                class="filter-btn px-6 py-2 rounded-lg font-semibold transition-all" data-filter="berita">
                                Berita & Pengumuman ({{ $beritas->count() }})
                            </button>
                        @endif
                        @if ($jurusans->isNotEmpty())
                            <button onclick="filterResults('jurusan')"
                                class="filter-btn px-6 py-2 rounded-lg font-semibold transition-all" data-filter="jurusan">
                                Program Keahlian ({{ $jurusans->count() }})
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Berita Results -->
                @if ($beritas->isNotEmpty())
                    <div class="result-section mb-12" data-type="berita">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3" data-aos="fade-right">
                            Berita & Pengumuman
                        </h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($beritas as $index => $berita)
                                <article
                                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group"
                                    data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="block">
                                        <div class="relative overflow-hidden h-48">
                                            @if ($berita->thumbnail)
                                                <img src="{{ Storage::url($berita->thumbnail) }}"
                                                    alt="{{ $berita->judul }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div
                                                    class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="absolute top-3 left-3">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $berita->kategori === 'berita' ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
                                                    {{ ucfirst($berita->kategori) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h3
                                                class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                                {!! str_ireplace($query, '<mark class="bg-yellow-200 px-1">' . $query . '</mark>', $berita->judul) !!}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                                {{ $berita->excerpt }}
                                            </p>
                                            <div class="flex items-center justify-between text-sm text-gray-500">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    {{ $berita->published_at->format('d M Y') }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    {{ $berita->views }} views
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Jurusan Results -->
                @if ($jurusans->isNotEmpty())
                    <div class="result-section" data-type="jurusan">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3" data-aos="fade-right">
                            Program Keahlian
                        </h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($jurusans as $index => $jurusan)
                                <article
                                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group hover:-translate-y-2"
                                    data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <a href="{{ route('jurusan.show', $jurusan->slug) }}" class="block">
                                        <div class="relative overflow-hidden h-48">
                                            @if ($jurusan->thumbnail)
                                                <img src="{{ Storage::url($jurusan->thumbnail) }}"
                                                    alt="{{ $jurusan->nama_jurusan }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div
                                                    class="w-full h-full bg-gradient-to-br from-green-500 to-green-700 flex items-center justify-center">
                                                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h3
                                                class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">
                                                {!! str_ireplace($query, '<mark class="bg-yellow-200 px-1">' . $query . '</mark>', $jurusan->nama_jurusan) !!}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                                {{ Str::limit(strip_tags($jurusan->deskripsi), 120) }}
                                            </p>
                                            <div
                                                class="flex items-center text-green-600 font-semibold text-sm group-hover:gap-2 transition-all">
                                                Lihat Detail
                                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Back to Home -->
                <div class="text-center mt-12" data-aos="fade-up">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .filter-btn {
            @apply bg-gray-100 text-gray-700;
        }

        .filter-btn.active {
            @apply bg-blue-600 text-white shadow-lg;
        }

        .filter-btn:hover:not(.active) {
            @apply bg-gray-200;
        }

        mark {
            @apply bg-yellow-200 px-1 rounded;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        function filterResults(type) {
            // Update button states
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Show/hide sections
            const sections = document.querySelectorAll('.result-section');
            sections.forEach(section => {
                if (type === 'semua') {
                    section.style.display = 'block';
                } else {
                    if (section.dataset.type === type) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                }
            });
        }
    </script>
@endsection
