@props(['active' => false])
<a {{ $attributes }} class="  hover:border-gray-300 hover:text-gray-800 block pr-3 pl-4 py-2 border-r-4 border-transparent text-base font-medium hover:bg-[var(--primary)] transition duration-300 {{ $active ? 'bg-[var(--primary)] text-white' : 'text-gray-600' }}">
    {{ $slot }}
</a>
