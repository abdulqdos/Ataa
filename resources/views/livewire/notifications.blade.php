<div
    x-data="{ showSidebar: @entangle('showNotifications') }"
    @click.outside="showSidebar = false"
>
    <div class="relative">

        {{-- زر الإشعارات --}}
        <button type="button" @click="showSidebar = !showSidebar" class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor"
                 class="w-6 h-6 text-gray-700">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967
                         8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967
                         8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085
                         5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714
                         0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>

            @if ($count > 0)
                <span class="absolute -top-1 -right-1 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full">
                    {{ $count }}
                </span>
            @endif
        </button>

        {{-- الـ Sidebar من اليسار --}}
        <div
            class="fixed top-0 left-0 w-96 h-full bg-white shadow-xl z-50 border-r border-gray-200 transition-all duration-300 ease-in-out transform"
            x-show="showSidebar"
            x-transition:enter="transform transition ease-in-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            @keydown.escape.window="showSidebar = false"
            style="display: none;"
        >
            <div class="flex items-center justify-between px-4 py-3 border-b">
                    <h2 class="text-lg font-semibold">الإشعارات</h2>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="text-xs text-secondary px-3 py-1 hover:underline cursor-pointer" wire:click="makeAllAsRead">
                            تحديد الكل كمقروء
                        </button>
                        <button type="button" class="text-xs text-red-500  px-3 py-1 hover:underline cursor-pointer" wire:click="deleteAll" >
                            حذف الكل
                        </button>
                        <button @click="showSidebar = false" class="text-gray-600 hover:text-gray-800 cursor-pointer">
                            ✖
                        </button>
                    </div>
            </div>

            <div class="overflow-y-auto h-[calc(100%-60px)]">
                @if($notifications->count() > 0)
                    <ul class="divide-y divide-gray-100">
                        @foreach($notifications as $notification)
                            <li class="py-4 hover:bg-gray-100 transition duration-300 cursor-pointer @if($notification->read_at === null) bg-gray-100 @else bg-white @endif" wire:click="makeAsRead({{  $notification->id }})">
                                <div class="flex justify-between items-start px-4">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $notification->title }}
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
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
                @else
                    <div class="flex flex-col items-center justify-center mt-20 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-10 w-10 mb-2 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                        <p class="text-sm">لا توجد إشعارات حالياً</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
