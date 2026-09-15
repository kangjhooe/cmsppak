@php
    $legalLinks = [
        ['route' => 'privacy', 'label' => 'Kebijakan Privasi'],
        ['route' => 'terms', 'label' => 'Syarat Layanan'],
        ['route' => 'cookies', 'label' => 'Kebijakan Cookie'],
    ];
@endphp

<nav class="flex flex-wrap gap-2 mb-8" aria-label="Navigasi dokumen hukum">
    @foreach($legalLinks as $link)
        <a href="{{ route($link['route']) }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                  {{ request()->routeIs($link['route'])
                      ? 'bg-green-600 text-white'
                      : 'bg-white text-gray-700 hover:bg-green-50 hover:text-green-700 border border-gray-200' }}">
            {{ $link['label'] }}
        </a>
    @endforeach
</nav>
