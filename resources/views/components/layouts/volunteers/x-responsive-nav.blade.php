@props(['active' => false ])
<a {{ $attributes->merge(['class' => 'block rounded-md bg-[var(--primary)] px-3 py-2 text-base font-medium text-white' . ($active ? 'bg-[var(--secondary)] text-white' : '') ]) }} aria-current="page">{{ $slot }}</a>
