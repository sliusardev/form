@props([
    'id' => uniqid('copy-text-'),
    'text' => '',
    'textColor' => 'text-blue-600 hover:text-blue-800',
    'tooltipText' => 'Copied!',
    'extraClasses' => 'ml-1'
])

<div {{ $attributes->merge(['class' => "relative group {$extraClasses}"]) }}>
    <span
        id="{{ $id }}"
        class="cursor-pointer {{ $textColor }} flex items-center gap-1"
        onclick="copyToClipboard('{{ $id }}')"
    >
        {{ $text ?? $slot }}
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
    </span>
    <span
        id="tooltip-{{ $id }}"
        class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 transition-opacity duration-300 pointer-events-none"
    >
        {{ $tooltipText }}
    </span>
</div>

@once
    @push('scripts')
        <script>
            function copyToClipboard(elementId) {
                const text = document.getElementById(elementId).innerText;
                navigator.clipboard.writeText(text)
                    .then(() => {
                        const tooltipId = `tooltip-${elementId}`;
                        const tooltip = document.getElementById(tooltipId);
                        tooltip.classList.add('opacity-100');
                        setTimeout(() => {
                            tooltip.classList.remove('opacity-100');
                        }, 2000);
                    })
                    .catch(err => {
                        console.error('Failed to copy: ', err);
                    });
            }
        </script>
    @endpush
@endonce
