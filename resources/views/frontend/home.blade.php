@extends('layouts.app')

@section('title', 'Homepage')

@section('content')

    <!-- Hero Slider -->
    <section class="relative">
        @if ($sliders->count() > 0)
            <div class="swiper heroSwiper">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide ">
                            <div class="relative h-[600px] overflow-hidden">
                                <!-- Background Image -->
                                @if ($slider->image_url)
                                    <img src="{{ Storage::url($slider->image_url) }}" alt="{{ $slider->judul }}"
                                        class="w-full h-full object-cover">
                                @endif

                                <!-- Gradient Overlay -->
                                {{-- <div
                                    class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-blue-800/85 to-blue-900/90">
                                </div> --}}

                                <!-- Decorative Elements -->
                                <div
                                    style="position: absolute; width: 18rem; height: 18rem; background: rgba(59, 130, 246, 0.3); border-radius: 50%; filter: blur(60px); top: 5rem; left: 5rem; animation: blob 7s infinite;">
                                </div>

                                <!-- Content -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="container mx-auto px-4">
                                        <div class="max-w-4xl mx-auto text-center text-white">
                                            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl p-8 md:p-12"
                                                data-aos="zoom-in">
                                                <h1 class="text-5xl md:text-7xl font-bold mb-6" data-aos="fade-up"
                                                    data-aos-delay="200">
                                                    {{ $slider->judul }}
                                                </h1>
                                                <p class="text-xl md:text-2xl mb-8 text-gray-100" data-aos="fade-up"
                                                    data-aos-delay="300">
                                                    {{ $slider->deskripsi }}
                                                </p>
                                                @if ($slider->link)
                                                    <a href="{{ $slider->link }}"
                                                        class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-yellow-400 hover:text-blue-900 transition-all shadow-2xl hover:scale-105"
                                                        data-aos="fade-up" data-aos-delay="400">
                                                        Selengkapnya
                                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination !bottom-8"></div>
                <div class="swiper-button-next !text-white"></div>
                <div class="swiper-button-prev !text-white"></div>
            </div>
        @endif
    </section>

    <!-- Jurusan Section -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Program Keahlian</h2>
                <p class="text-gray-600 text-lg">Pilih jurusan yang sesuai dengan minat dan bakatmu</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($jurusans as $jurusan)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if ($jurusan->thumbnail)
                            <img src="{{ Storage::url($jurusan->thumbnail) }}" alt="{{ $jurusan->nama_jurusan }}"
                                class="w-full h-48 object-cover rounded-t-lg">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-blue-700 rounded-t-lg"></div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $jurusan->nama_jurusan }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $jurusan->deskripsi }}</p>
                            <a href="{{ route('jurusan.show', $jurusan->slug) }}"
                                class="text-blue-600 font-semibold hover:text-blue-800 transition">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('jurusan.index') }}"
                    class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Lihat Semua Jurusan
                </a>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
                <p class="text-gray-600 text-lg">Informasi dan kabar terkini dari sekolah</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($beritas as $berita)
                    <article
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if ($berita->thumbnail)
                            <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-300 to-gray-400"></div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold mr-2">
                                    {{ ucfirst($berita->kategori) }}
                                </span>
                                <span>{{ $berita->published_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $berita->judul }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $berita->excerpt }}</p>
                            <a href="{{ route('berita.show', $berita->slug) }}"
                                class="text-blue-600 font-semibold hover:text-blue-800 transition">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('berita.index') }}"
                    class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Preview -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Galeri Kegiatan</h2>
                <p class="text-gray-600 text-lg">Dokumentasi kegiatan dan aktivitas sekolah</p>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 mt-10">
                @foreach ($galeris as $item)
                    <div data-aos="zoom-in" class="relative group overflow-hidden rounded-xl shadow">
                        <img src="{{ asset('storage/' . $item->file_url) }}" alt="{{ $item->judul }}"
                            class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition flex flex-col justify-center items-center text-white p-4">
                            <h3 class="font-semibold text-lg">{{ $item->judul }}</h3>
                            <p class="text-sm text-gray-200 mt-1">{{ $item->kategori }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('galeri') }}"
                    class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Lihat Semua Galeri
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Initialize Swiper for Hero Slider
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            spaceBetween: 30, // Jarak antar slide 30px
            slidesPerView: 1, // Tampilkan 1 slide
            centeredSlides: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Initialize GLightbox
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    </script>
@endpush
