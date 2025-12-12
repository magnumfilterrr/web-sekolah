@props(['berita'])

<a href="{{ route('berita.show', $berita->slug) }}"
    class="block bg-white rounded-xl shadow hover:shadow-lg overflow-hidden transition" data-aos="fade-up">
    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}" class="h-48 w-full object-cover">
    <div class="p-4">
        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ ucfirst($berita->kategori) }}</span>
        <h3 class="font-semibold text-lg mt-2">{{ $berita->judul }}</h3>
        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($berita->excerpt, 100) }}</p>
    </div>
</a>
