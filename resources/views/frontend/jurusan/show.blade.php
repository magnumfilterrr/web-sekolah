@extends('layouts.app')

@section('title', $jurusan->nama_jurusan)

@section('content')

    <!-- Hero Section -->
    <section class="relative h-96 bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden">
        @if ($jurusan->thumbnail)
            <img src="{{ Storage::url($jurusan->thumbnail) }}" alt="{{ $jurusan->nama_jurusan }}"
                class="absolute inset-0 w-full h-full object-cover opacity-30">
        @endif
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-4xl" data-aos="fade-up">
                <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Program Keahlian
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $jurusan->nama_jurusan }}</h1>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="bg-gray-50 py-4 border-b">
        <div class="max-w-screen-xl mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('jurusan.index') }}"
                                class="ml-1 text-sm text-gray-700 hover:text-blue-600">Jurusan</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1 text-sm text-gray-500 md:ml-2">{{ $jurusan->nama_jurusan }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Deskripsi -->
            <div class="mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Tentang Jurusan</h2>
                <div class="prose max-w-none">
                    <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $jurusan->deskripsi }}</p>
                </div>
            </div>

            <!-- Kompetensi Lulusan -->
            @if ($jurusan->kompetensi_lulusan)
                <div class="mb-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-blue-50 rounded-lg p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Kompetensi Lulusan</h2>
                        </div>
                        <div class="prose max-w-none">
                            <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $jurusan->kompetensi_lulusan }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Prospek Karir -->
            @if ($jurusan->prospek_karir)
                <div class="mb-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-green-50 rounded-lg p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Prospek Karir</h2>
                        </div>
                        <div class="prose max-w-none">
                            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $jurusan->prospek_karir }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- CTA -->
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg p-8 text-white">
                    <h3 class="text-2xl font-bold mb-4">Tertarik dengan jurusan ini?</h3>
                    <p class="text-lg mb-6">Hubungi kami untuk informasi lebih lanjut tentang pendaftaran</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('kontak') }}"
                            class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Hubungi Kami
                        </a>
                        <a href="{{ route('jurusan.index') }}"
                            class="inline-block bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                            Lihat Jurusan Lain
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
