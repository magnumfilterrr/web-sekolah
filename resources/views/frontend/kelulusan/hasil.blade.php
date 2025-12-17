@extends('layouts.app')

@section('title', 'Hasil Kelulusan - ' . $kelulusan->nama_siswa)

@section('content')
    <!-- Hero Section dengan kondisi warna berbeda -->
    <section
        class="mt-16 py-20 {{ $kelulusan->isLulusLunas() ? 'bg-gradient-to-r from-blue-600 to-blue-800' : 'bg-gradient-to-r from-red-600 to-red-800' }} text-white">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center" data-aos="fade-up">
                <div class="mb-6">
                    @if ($kelulusan->isLulusLunas())
                        <!-- Icon Success -->
                        <svg class="w-24 h-24 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    @else
                        <!-- Icon Lock/Error -->
                        <svg class="w-24 h-24 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    @if ($kelulusan->isLulusLunas())
                        Selamat! Anda Dinyatakan Lulus
                    @else
                        Mohon Maaf
                    @endif
                </h1>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Data Siswa Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                    </svg>
                    Data Siswa
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-gray-600 block mb-1">Nama Lengkap</label>
                        <p class="text-lg font-bold text-gray-900">{{ $kelulusan->nama_siswa }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-600 block mb-1">NIS</label>
                        <p class="text-lg font-bold text-gray-900">{{ $kelulusan->nis }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-600 block mb-1">Program Keahlian</label>
                        <p class="text-lg font-bold text-gray-900">{{ $kelulusan->jurusan->nama_jurusan }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-600 block mb-1">Tahun Kelulusan</label>
                        <p class="text-lg font-bold text-gray-900">{{ $kelulusan->tahun_lulus }}</p>
                    </div>
                </div>
            </div>

            <!-- KONDISI 1: LULUS + LUNAS -->
            @if ($kelulusan->isLulusLunas())
                <div class="bg-gradient-to-br from-blue-50 to-emerald-50 border-2 border-blue-500 rounded-xl shadow-lg p-8"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 rounded-full mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-blue-800 mb-2">
                            🎉 Selamat Atas Kelulusan Anda!
                        </h3>
                        <p class="text-black-700 text-lg">
                            Administrasi pembayaran telah lunas
                        </p>
                    </div>

                    <div class="bg-white rounded-lg p-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-700 font-semibold">Status Kelulusan:</span>
                            <span class="px-4 py-2 bg-green-500 text-white rounded-full font-bold">✅ LULUS</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-semibold">Status Pembayaran:</span>
                            <span class="px-4 py-2 bg-green-500 text-white rounded-full font-bold">💰 LUNAS</span>
                        </div>
                    </div>

                    @if ($kelulusan->file_pdf)
                        <div class="text-center">
                            <p class="text-gray-700 mb-4">
                                Anda dapat mengunduh sertifikat kelulusan dengan klik tombol di bawah ini:
                            </p>
                            <a href="{{ route('kelulusan.download', $kelulusan->id) }}"
                                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download Sertifikat Kelulusan (PDF)
                            </a>
                        </div>
                    @else
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                            <p class="font-semibold">⚠️ File sertifikat sedang diproses</p>
                            <p class="text-sm mt-1">Silakan coba beberapa saat lagi atau hubungi bagian administrasi</p>
                        </div>
                    @endif

                    @if ($kelulusan->keterangan)
                        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                            <p class="text-sm font-semibold text-blue-900 mb-1">Catatan:</p>
                            <p class="text-blue-800">{{ $kelulusan->keterangan }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- KONDISI 2: LULUS + BELUM BAYAR (TIDAK KASIH TAHU LULUS) -->
            @if ($kelulusan->isLulusBelumBayar())
                <div class="bg-gradient-to-br from-red-50 to-pink-50 border-2 border-red-500 rounded-xl shadow-lg p-8"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-500 rounded-full mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-red-800 mb-2">
                            Akses Ditangguhkan
                        </h3>
                        <p class="text-red-700 text-lg">
                            Anda belum dapat mengakses keterangan kelulusan
                        </p>
                    </div>

                    <div class="bg-red-100 border-l-4 border-red-600 text-red-900 p-6 rounded-lg mb-6">
                        <p class="font-bold text-xl mb-4">🔒 Informasi Penting</p>
                        <p class="mb-4 text-lg leading-relaxed">
                            Mohon maaf, Anda tidak dapat mengakses <span class="font-bold">Keterangan Kelulusan</span> saat
                            ini.
                        </p>
                        <p class="font-semibold text-lg">
                            Silakan selesaikan terlebih dahulu <span class="text-red-800 font-bold">kewajiban administrasi
                                keuangan</span> ke bagian Bendahara/Tata Usaha.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg p-6 border-2 border-red-200">
                        <h4 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Langkah Selanjutnya:
                        </h4>
                        <ol class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-red-600">1.</span>
                                <span>Hubungi bagian <span class="font-semibold">Bendahara/Tata Usaha</span> sekolah</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-red-600">2.</span>
                                <span>Selesaikan pembayaran administrasi yang tertunggak</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="font-bold text-red-600">3.</span>
                                <span>Setelah lunas, Anda dapat mengakses keterangan kelulusan</span>
                            </li>
                        </ol>
                    </div>

                    @if ($kelulusan->keterangan)
                        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                            <p class="text-sm font-semibold text-blue-900 mb-1">Catatan dari Sekolah:</p>
                            <p class="text-blue-800">{{ $kelulusan->keterangan }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- KONDISI 3: TIDAK LULUS -->
            @if ($kelulusan->isTidakLulus())
                <div class="bg-gradient-to-br from-red-50 to-pink-50 border-2 border-red-500 rounded-xl shadow-lg p-8"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-500 rounded-full mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-red-800 mb-2">
                            Mohon Maaf
                        </h3>
                        <p class="text-red-700 text-lg">
                            Anda belum memenuhi syarat kelulusan
                        </p>
                    </div>

                    <div class="bg-white rounded-lg p-6 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-semibold">Status Kelulusan:</span>
                            <span class="px-4 py-2 bg-red-500 text-white rounded-full font-bold">❌ TIDAK LULUS</span>
                        </div>
                    </div>

                    <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-6 rounded-lg mb-6">
                        <p class="font-bold text-lg mb-3">Informasi</p>
                        <p class="mb-4">
                            Berdasarkan hasil evaluasi, Anda belum memenuhi kriteria kelulusan yang telah ditetapkan.
                        </p>
                        <p class="font-semibold">
                            Untuk informasi lebih lanjut, silakan hubungi bagian <span class="text-red-900">Akademik / Wali
                                Kelas</span>.
                        </p>
                    </div>

                    @if ($kelulusan->file_pdf)
                        <div class="text-center mb-6">
                            <p class="text-gray-700 mb-4">
                                Anda dapat mengunduh surat keterangan dengan klik tombol di bawah ini:
                            </p>
                            <a href="{{ route('kelulusan.download', $kelulusan->id) }}"
                                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download Surat Keterangan (PDF)
                            </a>
                        </div>
                    @else
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                            <p class="font-semibold">⚠️ File surat keterangan sedang diproses</p>
                            <p class="text-sm mt-1">Silakan coba beberapa saat lagi atau hubungi bagian administrasi</p>
                        </div>
                    @endif

                    @if ($kelulusan->keterangan)
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                            <p class="text-sm font-semibold text-blue-900 mb-1">Catatan:</p>
                            <p class="text-blue-800">{{ $kelulusan->keterangan }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('kelulusan.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    Cek NIS Lain
                </a>

                <a href="{{ route('kontak') }}"
                    class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    Hubungi Sekolah
                </a>
            </div>
        </div>
    </section>
@endsection
