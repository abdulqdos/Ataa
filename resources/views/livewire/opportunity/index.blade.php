<div class="bg-gray-50">
    <div class="container mx-auto px-6 lg:px-24 py-2">

        <!-- Search && Filter -->
        <div id="top" class="bg-white rounded-lg shadow-sm p-3 transition-all duration-300 rtl text-sm" dir="rtl">
            <div class="flex flex-col gap-2">
                <!-- Search and Filter Row -->
                <div class="flex flex-col md:flex-row gap-2 items-stretch">
                    <!-- Search Box -->
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            placeholder="ابحث عن فرصة تطوعية..."
                            wire:model.live="searchText"
                            class="w-full pr-8 py-1.5 px-2 text-xs rounded-md border border-gray-200 focus:border-blue-300 focus:ring-1 focus:ring-blue-200 focus:outline-none placeholder-gray-400 transition"
                        />
                    </div>

                    <!-- Status Filter -->
                    <div class="relative min-w-[120px]">
                        <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                            </svg>
                        </div>
                        <select
                            class="w-full text-xs pr-8 py-1.5 px-2 rounded-md border border-gray-200 focus:border-blue-300 focus:ring-1 focus:ring-blue-200 focus:outline-none bg-white cursor-pointer transition"
                            wire:model.live="status">
                            <option value="">كل الحالات</option>
                            <option value="upcoming">قريباً</option>
                            <option value="active">نشطة</option>
                            <option value="completed">مكتملة</option>
                        </select>
                    </div>
                </div>

                <!-- Date Filter -->
                <div class="p-2 rounded-md border border-gray-200">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-[11px] font-medium text-gray-600">تصفية حسب التاريخ</h3>
                        <button wire:click="clear" class="text-red-500 hover:text-red-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1">
                            <label class="block text-[11px] text-gray-500 mb-0.5">من تاريخ</label>
                            <input type="date" wire:model.live="start_date"
                                   class="w-full text-xs py-1 px-2 rounded-md border border-gray-200 focus:border-blue-300 focus:outline-none" />
                        </div>
                        <div class="flex-1">
                            <label class="block text-[11px] text-gray-500 mb-0.5">إلى تاريخ</label>
                            <input type="date" wire:model.live="end_date"
                                   class="w-full text-xs py-1 px-2 rounded-md border border-gray-200 focus:border-blue-300 focus:outline-none" />
                        </div>
                    </div>
                </div>

                <!-- Certificate & Sector -->
                <div class="p-2 rounded-md border border-gray-200">
                    <h3 class="text-[11px] font-medium text-gray-600 mb-1">تصفية حسب الشهادة والقطاع</h3>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1">
                            <label class="block text-[11px] text-gray-500 mb-0.5">نوع الشهادة</label>
                            <select wire:model.live="with_certificate"
                                    class="w-full text-xs py-1.5 px-2 rounded-md border border-gray-200 focus:border-blue-300 focus:ring-1 focus:ring-blue-200 focus:outline-none bg-white transition">
                                <option value="">الكل</option>
                                <option value="1">بشهادة</option>
                                <option value="0">بدون شهادة</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[11px] text-gray-500 mb-0.5">القطاع</label>
                            <select wire:model.live="sector"
                                    class="w-full text-xs py-1.5 px-2 rounded-md border border-gray-200 focus:border-blue-300 focus:ring-1 focus:ring-blue-200 focus:outline-none bg-white transition">
                                <option value="">كل القطاعات</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @if($opportunities->count() > 0)
            <!-- عرض الفرص التطوعية -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-3">
                @foreach($opportunities as $opportunity)
                    <div class="bg-white shadow-sm rounded-md overflow-hidden">
                        <!-- Image with Certificate Badge -->
                        <div class="flex items-center justify-center h-48 md:h-56 relative">
                            @if($opportunity->img_url === null)
                                <img class="h-full w-full object-cover"
                                     src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff"
                                     alt="صورة المؤسسة">
                            @else
                                <img class="h-full w-full object-cover"
                                     src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}"
                                     alt="صورة المؤسسة">
                            @endif

                            <!-- Certificate Badge -->
                            @if($opportunity->has_certificate)
                                <div class="absolute top-2 right-2 bg-green-100 text-green-800 px-3 py-1 rounded-md text-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                                    </svg>
                                    <span>شهادة</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-5 space-y-4">
                            <div class="flex flex-row justify-between items-center">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $opportunity->title }}</h2>
                                <x-layouts.status-opportunity :opportunity="$opportunity" />
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center text-base text-gray-700">
                                    <span class="font-semibold min-w-[80px]">المؤسسة:</span>
                                    <span class="mr-2">{{ $opportunity->organization->name }}</span>
                                </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="text-base text-gray-700">
                                            <p class="font-semibold">زمن البداية</p>
                                            <p>{{ \Carbon\Carbon::parse( $opportunity->start_time)->format('H:i') }}</p>
                                        </div>

                                        <div class="text-base text-gray-700">
                                            <p class="font-semibold">زمن النهاية</p>
                                            <p>{{ \Carbon\Carbon::parse($opportunity->end_time)->format('H:i') }}</p>
                                        </div>
                                    </div>


                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-base text-gray-700">
                                        <p class="font-semibold">البداية</p>
                                        <p>{{ \Carbon\Carbon::parse($opportunity->start_date)->format('d-m-Y') }}</p>
                                    </div>

                                    <div class="text-base text-gray-700">
                                        <p class="font-semibold">النهاية</p>
                                        <p>{{ \Carbon\Carbon::parse($opportunity->end_date)->format('d-m-Y') }}</p>
                                    </div>
                                </div>

                                <div class="text-base text-gray-700">
                                    <span class="font-semibold">الموقع:</span>
                                    <a href="{{ $opportunity->location_url }}"
                                       class="text-blue-500 hover:underline"
                                       target="_blank">
                                        {{ $opportunity->location }}
                                    </a>
                                </div>

                                <div class="text-base text-gray-700">
                                    <span class="font-semibold">النطاق:</span>
                                    <span>{{ $opportunity->sector->name }}</span>
                                </div>

                                <!-- Certificate Indicator -->
                                @if($opportunity->has_certificate)
                                    <div class="text-base text-green-600 bg-green-50 p-2 rounded-md flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                                        </svg>
                                        <span>هذه الفرصة تمنح شهادة مشاركة</span>
                                    </div>
                                @endif

                                <div class="text-base text-gray-700">
                                    <div class="flex justify-between mb-2">
                                        <span class="font-semibold">المتطوعين:</span>
                                        <span>{{ $opportunity->accepted_count }}/{{ $opportunity->count }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary h-2 rounded-full"
                                             style="width: {{ ($opportunity->accepted_count/$opportunity->count)*100 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <a href="{{ route('opportunities.show', $opportunity->id) }}"
                                   wire:navigate.keep
                                   class="block text-center px-6 py-3 text-base font-medium rounded-md
                  shadow-sm text-white bg-primary hover:bg-primaryLight transition-all
                  duration-300 cursor-pointer">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                {{ $opportunities->links('vendor.pagination.custom') }}
            </div>

        @else
            <div class="flex items-center justify-between p-4 mb-4 my-10 lg:my-6 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 text-sm lg:text-lg" role="alert">
                <div class="flex flex-row items-center gap-4">
                    <svg class="shrink-0 w-4 h-4 me-3 hidden lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div>
                        <span class="font-medium">عذراً</span>
                        لم نعثر على فرص تطوعية تحت عنوان
                        @if(!empty($searchText))
                            <span class="font-semibold"> " {{ $searchText }}"</span>
                        @endif
                    </div>
                </div>
                <div>
                    <button type="button" class="text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center cursor-pointer transition duration-300" wire:click="clear">
                        <svg class="me-2 h-3 w-3 hidden lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                        </svg>
                        عرض كل الفرص التطوعية
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
