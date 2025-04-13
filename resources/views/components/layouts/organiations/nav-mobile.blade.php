@props(['active' => false , 'i'] )
<a href="#" class="sidebar-item  flex items-center px-4 py-3 text-sm hover:text-secondary hover:bg-gray-50 {{ $active ? 'active-link' : 'text-gray-500' }}">
    <i class="{{ $i }}"></i>
    <span> {{ $slot }}</span>
</a>
