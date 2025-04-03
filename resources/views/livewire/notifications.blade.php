<div>
    {{-- In work, do what you enjoy. --}}
    <div class="hidden md:flex mr-3 relative">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>

        @if($notifications->count() > 0)
            <ul class="max-w-md divide-y divide-gray-200  origin-top-left absolute left-0 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50 mt-8">
                @foreach($notifications as $notification)
                    <li class="flex items-center justify-between p-3  bg-white  border-b border-gray-300 transition duration-300 hover:bg-gray-200 cursor-pointer">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $notification->title }}
                                </p>
                                <p class="text-xs text-gray-600 ">
                                    {{ $notification->message }}
                                </p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">
                                      {{ $notification->created_at }}
                        </span>
                    </li>
                @endforeach


            </ul>
        @else
            <div class="max-w-md origin-top-left absolute left-0 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50 mt-8">
                <p class="text-black">ليس لديك إشعارات</p>
            </div>
        @endif
    </div>

</div>
