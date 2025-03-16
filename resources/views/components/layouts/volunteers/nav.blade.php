@props(['active' => false])
<a  class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium hover:border-[var(--primary)] hover:text-[var(--primary)] transition duration-300 {{ $active ? 'border-[var(--primary)] text-[var(--primary)]' : 'text-gray-500 border-gray-200'  }}" {{ $attributes }}>
    {{ $slot }}
</a>
