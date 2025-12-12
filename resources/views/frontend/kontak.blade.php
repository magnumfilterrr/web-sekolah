@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
    {{-- Hero Section --}}
    <x-frontend.hero-section title="Hubungi Kami"
        subtitle="Kami siap membantu dan menjawab pertanyaan Anda terkait {{ $settings['nama_sekolah'] ?? '-' }}" />

    {{-- Section Kontak --}}
    <section class="py-16 max-w-6xl mx-auto px-4">
        <x-frontend.section-title title="Informasi & Formulir Kontak"
            subtitle="Silakan hubungi kami melalui form di bawah atau datang langsung ke sekolah." />

        <div class="grid md:grid-cols-2 gap-10 mt-10">
            {{-- Informasi Sekolah --}}
            <div data-aos="fade-right">
                <h2 class="text-xl font-semibold mb-4 text-blue-700">Informasi Sekolah</h2>
                <ul class="space-y-3 text-gray-700 leading-relaxed">
                    <li><strong>Nama Sekolah:</strong> {{ $settings['nama_sekolah'] ?? '-' }}</li>
                    <li><strong>Alamat:</strong> {{ $settings['alamat'] ?? '-' }}</li>
                    <li><strong>Telepon:</strong> {{ $settings['telepon'] ?? '-' }}</li>
                    <li><strong>Email:</strong> {{ $settings['email'] ?? '-' }}</li>
                </ul>

                {{-- Tambahkan peta lokasi jika ingin --}}
                <div class="mt-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3614321604236!2d107.79302559999998!3d-7.313232199999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68a45ad4b64679%3A0x64ce2b04a39229aa!2sSMK%20Nurull%20Mutaqin%20Cisurupan!5e0!3m2!1sid!2sid!4v1762400493448!5m2!1sid!2sid"
                        width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" width="100%" height="250" style="border:0;"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

            {{-- Form Kontak --}}
            <div data-aos="fade-left">
                <h2 class="text-xl font-semibold mb-4 text-blue-700">Kirim Pesan</h2>

                {{-- Alert sukses jika ada --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Alert error --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('kontak.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap"
                            required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com"
                            required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Perihal pesan"
                            required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                        <textarea name="pesan" rows="5" placeholder="Tulis pesan Anda di sini..." required
                            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition resize-none">{{ old('pesan') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Kirim Pesan
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
