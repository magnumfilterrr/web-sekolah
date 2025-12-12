@props(['title', 'subtitle' => ''])

<div class="text-center mb-12" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $title }}</h2>
    @if ($subtitle)
        <p class="text-gray-600 text-lg max-w-3xl mx-auto">{{ $subtitle }}</p>
    @endif
</div>
