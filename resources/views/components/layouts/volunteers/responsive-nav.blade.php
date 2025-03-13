@props(['active' => false ])
<a {{ $attributes->merge(['class' => 'block rounded-md px-3 py-2 text-base font-medium text-white ' . ($active ? 'bg-[var(--secondary)]' : 'bg-[var(--primary)]')]) }} aria-current="page">
    {{ $slot }}
</a>
