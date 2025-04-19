@props([
    'title' => '',
    'breadcrumbs' => [],
])

<div class="max-w-full mx-5 px-4 py-2 mb-4 rounded-md" id="top">
    <div class="flex flex-row justify-between items-center">
        <div class="flex flex-col">
            <nav class="text-sm text-gray-500 space-x-1 rtl:space-x-reverse">
                @foreach ($breadcrumbs as $index => $crumb)
                    @if (is_array($crumb) && isset($crumb[1]))
                        <a href="{{ $crumb[1] }}" class="hover:underline text-gray-600">{{ $crumb[0] }}</a>
                        @if ($index < count($breadcrumbs) - 1)
                            <span class="mx-1 text-gray-400">›</span>
                        @endif
                    @else
                        <span class="text-gray-800">{{ is_array($crumb) ? $crumb[0] : $crumb }}</span>
                    @endif
                @endforeach
            </nav>
            <h1 class="text-xl text-primary font-semibold mt-1">{{ $title }}</h1>
        </div>

        @if ($slot->isNotEmpty())
            <div>
                {{ $slot }}
            </div>
        @endif
    </div>
</div>

