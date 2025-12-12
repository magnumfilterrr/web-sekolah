@props(['title', 'subtitle' => ''])

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-screen-xl mx-auto px-4 text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $title }}</h1>
        @if ($subtitle)
            <p class="text-xl md:text-2xl">{{ $subtitle }}</p>
        @endif
    </div>
</section>
