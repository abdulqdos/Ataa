    <div class="bg-gray-50">
        <div class="container mx-auto px-6 lg:px-24 py-2">

            <!-- Search && Filter -->
            <div class="bg-white rounded-md shadow-md p-4 transition-all duration-300">
                <div class="flex flex-col gap-4">
                    <!-- Search Box -->
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                placeholder="بحث عن فرصة..."
                                wire:model.live="searchText"
                                class="w-full pr-10 py-3 px-4 rounded-lg border-1 border-gray-200 focus:border-[var(--primaryLight)] focus:ring-1 focus:outline-none  text-right placeholder:text-gray-400"
                            />
                        </div>

                        <!--Filter List -->
                        <div class="relative min-w-[160px]">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                                </svg>
                            </div>
                            <select class="w-full appearance-none pr-10 py-3 px-4 rounded-lg border-1 border-gray-200 focus:border-[var(--primaryLight)] focus:ring-1 focus:outline-none  text-right bg-white cursor-pointer"
                                    wire:model.live="status">
                                <option value="">كل الحالات</option>
                                <option value="upcoming">قريبا</option>
                                <option value="active">نشطة</option>
                                <option value="completed">مكتملة</option>
                            </select>
                        </div>
                    </div>

                    <!-- فلترة التاريخ -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex flex-row items-center justify-between mx-4">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">تصفية حسب التاريخ</h3>
                            <button wire:click="clear">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 rounded-md bg-red-500 hover:bg-red-700 transition duration-300 text-white cursor-pointer p-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>


                        </div>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <label class="block text-sm text-gray-700 mb-2">من تاريخ</label>
                                <div class="relative">
                                    <input
                                        type="date"
                                        wire:model.live="start_date"
                                        class="w-full pr-10 py-2 px-4 rounded-lg border-1 border-gray-200 focus:border-[var(--primaryLight)] focus:outline-none text-right"
                                    />
                                </div>
                            </div>

                            <!-- إلى تاريخ -->
                            <div class="flex-1">
                                <label class="block text-sm text-gray-700 mb-2">إلى تاريخ</label>
                                <div class="relative">
                                    <input
                                        type="date"
                                        wire:model.live="end_date"
                                        class="w-full pr-10 py-2 px-4 rounded-lg border-1 border-gray-200 focus:border-[var(--primaryLight)] focus:outline-none text-right"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($opportunities->count() > 0)
                <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                    <button wire:click="previousPage" wire:loading.attr="disabled" class="bg-[var(--primary)] hover:bg-[var(--primaryLight)] text-white px-4 py-2 rounded-lg shadow transition duration-300 cursor-pointer disabled:bg-[var(--primaryLight)] disabled:opacity-75 disabled:cursor-default" @if ($opportunities->onFirstPage()) disabled @endif>
                        << السابق
                    </button>
                    <div class="text-gray-800 text-xl flex justify-center items-center gap-2 my-4 md:my-0">
                        <span>عرض</span>
                        <span class="font-bold">{{ $opportunities->firstItem() }}</span>
                        <span>إلى</span>
                        <span class="font-bold">{{ $opportunities->lastItem() }}</span>
                        <span>من</span>
                        <span class="font-bold">{{ $opportunities->total() }}</span>
                        <span>الفرص</span>
                    </div>
                    <button wire:click="nextPage" wire:loading.attr="disabled" class="bg-[var(--primary)] hover:bg-[var(--primaryLight)] text-white px-4 py-2 rounded-lg shadow transition duration-300 cursor-pointer disabled:bg-[var(--primaryLight)] disabled:opacity-75 disabled:cursor-default" @if (!$opportunities->hasMorePages()) disabled @endif>
                        التالي >>
                    </button>
                </div>

                <!-- عرض الفرص التطوعية -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-6">
                    @foreach($opportunities as $opportunity)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="flex items-center justify-center h-48">
                                @if($opportunity->img_url === null)
                                    <!-- إذا كانت الصورة غير موجودة نعرض صورة عشوائية بلون عشوائي -->
                                    <img class="h-full w-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff" alt="صورة المؤسسة">
                                @else
                                    <img class="h-full w-full object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="صورة المؤسسة">
                                @endif
                            </div>

                            <div class="p-4">
                                <div class="flex flex-row justify-between items-center mx-4">
                                    <h2 class="text-xl font-semibold mb-2">{{ $opportunity->title }}</h2>
                                    <div>
                                        <span
                                            class="
                                                w-4 px-4 py-1 rounded-md
                                                @if($opportunity->status === 'active')
                                                    bg-green-100 text-green-500
                                                @elseif($opportunity->status === 'upcoming')
                                                    bg-yellow-100 text-yellow-600
                                                @elseif($opportunity->status === 'completed')
                                                    bg-blue-100 text-blue-500
                                                @endif
                                            ">
                                            @if($opportunity->status === 'active')
                                                نشط
                                            @elseif($opportunity->status === 'upcoming')
                                                قريباً
                                            @elseif($opportunity->status === 'completed')
                                                مكتملة
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="text-sm text-gray-600 mb-1">
                                    <span class="font-bold">المؤسسة :</span>
                                    <span>
                                        {{ $opportunity->organization->name }}
                                </span>
                                </div>

                                <div class="text-sm text-gray-600 mb-1">
                                    <span class="font-bold">تبدأ:</span> {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d-m-Y') }}
                                </div>

                                <div class="text-sm text-gray-600 mb-1">
                                    <span class="font-bold">تنتهي:</span> {{ \Carbon\Carbon::parse($opportunity->end_date)->format('d-m-Y') }}
                                </div>

                                <div class="text-sm text-gray-600 mb-1">
                                    <span class="font-bold">المكان:</span>
                                    <a href="{{ $opportunity->location_url }}" class="text-blue-500" target="_blank">{{ $opportunity->location }}</a>
                                </div>

                                <div class="text-sm text-gray-600 mb-1">
                                    <span class="font-bold">المتطوعين المطلوبين:</span> {{ $opportunity->count }}
                                </div>

                                <div class="mt-4 ">
                                    <a href="{{ route('opportunities.show' ,  $opportunity->id ) }}" wire:navigate class="px-6 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[var(--primary)] hover:bg-[var(--primaryLight)] transition duration-300 w-full cursor-pointer ">
                                        عرض التفاصيل
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-between p-4 mb-4 my-10 lg:my-6  text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 text-sm lg:text-lg" role="alert">
                    <div class="flex flex-row items-center gap-4">
                        <svg class="shrink-0  w-4 h-4 me-3 hidden lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                        <button type="button" class="text-white bg-yellow-600 hover:bg-yellow-700  focus:outline-none font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center cursor-pointer transition duration-300" wire:click="clear">
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
