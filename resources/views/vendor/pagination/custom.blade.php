@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-4 my-6">
        {{-- زر السابق --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-primaryLight text-white rounded-lg cursor-default">
                << السابق
            </span>
        @else
            <button wire:click="previousPage" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primaryLight transition duration-300 cursor-pointer">
                << السابق
            </button>
        @endif

        {{-- الأرقام --}}
        <div class="flex gap-2">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 bg-primary text-white rounded-lg">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="px-3 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-300 cursor-pointer">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- زر التالي --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primaryLight transition duration-300 cursor-pointer">
                التالي >>
            </button>
        @else
            <span class="px-4 py-2 bg-primaryLight text-white  rounded-lg cursor-default">
                التالي >>
            </span>
        @endif
    </nav>
@endif
