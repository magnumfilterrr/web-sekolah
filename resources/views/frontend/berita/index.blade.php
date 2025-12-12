@extends('layouts.app')

@section('title', 'Berita & Pengumuman')

@section('content')

    <x-frontend.hero-section title="Berita & Pengumuman"
        subtitle="Informasi terkini seputar kegiatan dan pengumuman sekolah" />

    <!-- Filter -->
    <section class="bg-white border-b sticky top-[73px] z-40">
        <div class="max-w-screen-xl mx-auto px-4 py-4">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <div class="flex gap-2">
                    <a href="{{ route('berita.index') }}"
                        class="px-4 py-2 rounded-lg font-semibold transition {{ !request('kategori') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Semua
                    </a>
                    <a href="{{ route('berita.index', ['kategori' => 'berita']) }}"
                        class="px-4 py-2 rounded-lg font-semibold transition {{ request('kategori') == 'berita' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Berita
                    </a>
                    <a href="{{ route('berita.index', ['kategori' => 'pengumuman']) }}"
                        class="px-4 py-2 rounded-lg font-semibold transition {{ request('kategori') == 'pengumuman' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Pengumuman
                    </a>
                </div>
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold">{{ $beritas->total() }}</span> artikel
                </div>
            </div>
        </div>
    </section>

    <!-- Berita List -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">

            @if ($beritas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($beritas as $berita)
                        <article
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

                            <!-- Image -->
                            <a href="{{ route('berita.show', $berita->slug) }}" class="block">
                                @if ($berita->thumbnail)
                                    <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}"
                                        class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                @else
                                    <div
                                        class="w-full h-48 bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white opacity-50" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Meta -->
                                <div class="flex items-center text-sm text-gray-500 mb-3 gap-3">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $berita->kategori == 'berita' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ ucfirst($berita->kategori) }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $berita->published_at->format('d M Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $berita->views }}
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition">
                                    <a href="{{ route('berita.show', $berita->slug) }}" class="line-clamp-2">
                                        {{ $berita->judul }}
                                    </a>
                                </h3>

                                <!-- Excerpt -->
                                @if ($berita->excerpt)
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $berita->excerpt }}</p>
                                @endif

                                <!-- Read More -->
                                <a href="{{ route('berita.show', $berita->slug) }}"
                                    class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition group">
                                    Baca Selengkapnya
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $beritas->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-600">Berita dan pengumuman akan segera ditambahkan.</p>
                </div>
            @endif

        </div>
    </section>

@endsection
