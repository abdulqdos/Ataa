@props(['active' => false , 'i'])
<a {{ $attributes }} class="sidebar-item  flex items-center px-4 py-3 text-sm {{ $active ? 'active-link' : ''}}">
    <i class="{{ $i }}"></i>
    <span>{{ $slot }}</span>
</a>
