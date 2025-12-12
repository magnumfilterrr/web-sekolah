@props(['fasilitas'])

<div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition" data-aos="fade-up">
    <img src="{{ asset('storage/' . $fasilitas->foto) }}" alt="{{ $fasilitas->nama_fasilitas }}"
        class="h-48 w-full object-cover">
    <div class="p-4">
        <h3 class="font-semibold text-blue-700 text-lg mb-2">{{ $fasilitas->nama_fasilitas }}</h3>
        <p class="text-gray-600 text-sm">{{ $fasilitas->deskripsi }}</p>
    </div>
</div>
