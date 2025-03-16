@props(['active' => false])

<a {{ $attributes->merge(['class' => 'group  px-3 py-4  text-sm font-medium text-white  hover:bg-[var(--primaryLight)] transition duration-300' . ($active ? ' bg-[var(--primaryLight)]' : '')]) }}>
    {{ $slot }}
</a>
