@props(['active' => false])

<a {{ $attributes->merge(['class' => 'group  px-3 py-4 text-sm font-medium text-white  hover:bg-[var(--secondary)] transition duration-300' . ($active ? ' bg-[var(--secondary)]' : '')]) }}>
    {{ $slot }}
</a>
