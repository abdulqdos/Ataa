@props(['active' => false , 'i'])
<a {{ $attributes }} class="flex items-center px-4 py-3 text-sm  hover:text-secondary hover:bg-gray-50 {{ $active ? 'text-secondary border-r-4 border-white bg-gray-50' : 'text-gray-500 bg-white' }}">
    <i class="{{ $i }}"></i>
    <span>{{ $slot }}</span>
</a>
