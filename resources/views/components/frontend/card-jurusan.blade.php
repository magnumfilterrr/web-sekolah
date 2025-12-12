@props(['jurusan'])

<a href="{{ route('jurusan.show', $jurusan->slug) }}"
    class="block bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition" data-aos="zoom-in">
    <img src="{{ asset('storage/' . $jurusan->thumbnail) }}" alt="{{ $jurusan->nama_jurusan }}"
        class="h-48 w-full object-cover">
    <div class="p-4">
        <h3 class="font-semibold text-blue-700 text-lg mb-2">{{ $jurusan->nama_jurusan }}</h3>
        <p class="text-gray-600 text-sm">{{ Str::limit($jurusan->deskripsi, 120) }}</p>
    </div>
</a>
