@extends('layouts.app')

@section('title', 'Cek Kelulusan')

@section('content')


    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center" data-aos="fade-up">
                <div class="mb-6">
                    <svg class="w-20 h-20 mx-auto text-white opacity-90" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Cek Kelulusan Siswa
                </h1>
                <p class="text-xl text-green-100 max-w-2xl mx-auto">
                    Masukkan Nomor Induk Siswa (NIS) Anda untuk mengecek status kelulusan dan mengunduh Surat Keterangan
                    Lulus
                </p>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="max-w-2xl mx-auto">

                <!-- Alert Messages -->
                @if (session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert"
                        data-aos="fade-down">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <p class="font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert"
                        data-aos="fade-down">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <p class="font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="bg-white rounded-xl shadow-xl p-8" data-aos="fade-up">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            Input Token NIS
                        </h2>
                        <p class="text-gray-600">
                            Masukkan Nomor Induk Siswa (NIS) Anda yang telah terdaftar
                        </p>
                    </div>

                    <form action="{{ route('kelulusan.cek') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="token" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Induk Siswa (NIS)
                            </label>
                            <input type="text" id="token" name="token" value="{{ old('token') }}"
                                class="w-full px-4 py-3 text-lg border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all @error('token') border-red-500 @enderror"
                                placeholder="Contoh: 2024001" required autofocus>
                            @error('token')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                💡 Pastikan NIS yang Anda masukkan sesuai dengan yang terdaftar di sekolah
                            </p>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                </path>
                            </svg>
                            Cek Kelulusan
                        </button>
                    </form>
                </div>

                <!-- Info Box -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        Informasi Penting
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-800">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-1">•</span>
                            <span>Gunakan NIS yang telah terdaftar di sekolah</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-1">•</span>
                            <span>Pastikan Anda telah menyelesaikan administrasi pembayaran untuk dapat mengunduh sertifikat
                                kelulusan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-600 mt-1">•</span>
                            <span>Jika mengalami kendala, silakan hubungi bagian administrasi sekolah</span>
                        </li>
                    </ul>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-8" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-semibold transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18">
                            </path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
