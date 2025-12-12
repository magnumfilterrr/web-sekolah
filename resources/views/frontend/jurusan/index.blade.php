@extends('layouts.app')

@section('title', 'Program Keahlian')

@section('content')

    <x-frontend.hero-section title="Program Keahlian" subtitle="Pilih jurusan yang sesuai dengan minat dan bakat Anda" />

    <!-- Jurusan List -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">

            @if ($jurusans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($jurusans as $jurusan)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                            <!-- Image -->
                            @if ($jurusan->thumbnail)
                                <img src="{{ Storage::url($jurusan->thumbnail) }}" alt="{{ $jurusan->nama_jurusan }}"
                                    class="w-full h-56 object-cover">
                            @else
                                <div
                                    class="w-full h-56 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Badge -->
                                <div
                                    class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                                    Program Keahlian
                                </div>

                                <!-- Title -->
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $jurusan->nama_jurusan }}</h3>

                                <!-- Description -->
                                <p class="text-gray-600 mb-4 leading-relaxed line-clamp-4">
                                    {{ $jurusan->deskripsi }}
                                </p>

                                <!-- Button -->
                                <a href="{{ route('jurusan.show', $jurusan->slug) }}"
                                    class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition group">
                                    Lihat Detail
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Jurusan</h3>
                    <p class="text-gray-600">Data jurusan akan segera ditambahkan.</p>
                </div>
            @endif

        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-screen-xl mx-auto px-4 text-center" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Tertarik Bergabung?</h2>
            <p class="text-xl mb-8">Daftarkan diri Anda sekarang dan raih masa depan cerah bersama kami!</p>
            <a href="{{ route('kontak') }}"
                class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition shadow-lg">
                Hubungi Kami
            </a>
        </div>
    </section>

@endsection
