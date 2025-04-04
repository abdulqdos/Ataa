<div
    x-data
    @click.outside="$dispatch('closeNotifications')"
>
    {{-- In work, do what you enjoy. --}}
    <div class="hidden md:flex mr-3 relative">


        <button type="button" wire:click="toggleShowNotifications" class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>

            @if ($count > 0)
                <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full -mt-1 -mr-1">
                    {{ $count }}
                </span>
            @endif
        </button>


    @if($showNotifications)
            @if($notifications->count() > 0)
                <div class="absolute left-0 mt-12 w-96 z-50">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden ring-1 ring-gray-100 ring-opacity-5">
                        <!-- رأس الإشعارات -->
                        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-800">الإشعارات</h2>
                        </div>

                        <!-- قائمة الإشعارات -->
                        <ul class="divide-y divide-gray-100">
                            @foreach($notifications as $notification)
                                <li class="p-4 hover:bg-gray-50 transition duration-200 cursor-pointer">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $notification->title }}
                                            </p>
                                            <p class="text-xs text-gray-600 mt-1">
                                                {{ $notification->message }}
                                            </p>
                                        </div>
                                        <span class="text-xs text-gray-400 whitespace-nowrap ml-2 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- زر عرض الكل -->
                        <div class="px-4 py-2 border-t border-gray-200 bg-gray-50 flex justify-end">
                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                عرض الكل
                            </a>
                        </div>
                    </div>
                </div>


            @else
                <div class="max-w-md origin-top-left absolute left-0 w-80 rounded-md shadow-lg py-3 bg-gray-50 ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50 mt-8">
                    <div class="flex items-center justify-center text-center space-x-2">
                        <p class="text-sm text-gray-600">ليس لديك إشعارات</p>
                    </div>
                </div>
            @endif
        @endif
    </div>

</div>
