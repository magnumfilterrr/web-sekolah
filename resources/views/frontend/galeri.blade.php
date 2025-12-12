@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

    <x-frontend.hero-section title="Galeri" subtitle="Dokumentasi kegiatan dan aktivitas sekolah" />

    <!-- Filter Tabs -->
    <section class="bg-white border-b sticky top-[73px] z-40">
        <div class="max-w-screen-xl mx-auto px-4 py-4">
            <div class="flex gap-2">
                <a href="{{ route('galeri', ['tipe' => 'foto']) }}"
                    class="px-6 py-2 rounded-lg font-semibold transition {{ $tipe == 'foto' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                        Foto
                    </span>
                </a>
                <a href="{{ route('galeri', ['tipe' => 'video']) }}"
                    class="px-6 py-2 rounded-lg font-semibold transition {{ $tipe == 'video' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                        </svg>
                        Video
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Content -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">

            @if ($galeris->count() > 0)

                @if ($tipe == 'foto')
                    <!-- Photo Gallery -->
                    <div class="columns-1 md:columns-2 lg:columns-3 gap-4 space-y-4">
                        @foreach ($galeris as $galeri)
                            <div class="break-inside-avoid" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 6) * 50 }}">
                                <a href="{{ Storage::url($galeri->file_url) }}"
                                    class="glightbox block group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300"
                                    data-gallery="gallery-foto" data-title="{{ $galeri->judul }}">
                                    <img src="{{ Storage::url($galeri->file_url) }}" alt="{{ $galeri->judul }}"
                                        class="w-full h-auto group-hover:scale-110 transition-transform duration-500">

                                    <!-- Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                        <div class="p-4 w-full">
                                            <h3 class="text-white font-semibold mb-1">{{ $galeri->judul }}</h3>
                                            @if ($galeri->deskripsi)
                                                <p class="text-white/80 text-sm line-clamp-2">{{ $galeri->deskripsi }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- View Icon -->
                                    <div
                                        class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Video Gallery -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($galeris as $galeri)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
                                data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                                <div class="relative aspect-video">
                                    @php
                                        // Extract YouTube ID from URL
                                        preg_match(
                                            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                                            $galeri->file_url,
                                            $matches,
                                        );
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp

                                    @if ($youtubeId)
                                        <iframe class="w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                            title="{{ $galeri->judul }}" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <p class="text-gray-500">Video tidak tersedia</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $galeri->judul }}</h3>
                                    @if ($galeri->deskripsi)
                                        <p class="text-gray-600 text-sm line-clamp-2">{{ $galeri->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        @if ($tipe == 'foto')
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada {{ ucfirst($tipe) }}</h3>
                    <p class="text-gray-600">{{ ucfirst($tipe) }} galeri akan segera ditambahkan.</p>
                </div>
            @endif

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Initialize GLightbox for photos
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    </script>
@endpush
