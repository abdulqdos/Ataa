<div>
    <!-- قسم الهيرو -->
    <section class="relative h-[600px]">
        <!-- صورة الخلفية مع تغطية -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/organization-bg.jpg') }}"
                 alt="مؤسسات"
                 class="w-full h-[600px] object-cover">
            <!-- طبقة تظليل -->
            <div class="absolute inset-0 bg-primary/80 mix-blend-multiply"></div>
        </div>

        <!-- المحتوى -->
        <div class="container mx-auto relative z-10 h-full flex items-center justify-center text-center px-4">
            <div class="max-w-4xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white leading-tight">
                    <span class="text-secondary">مؤسساتٌ</span> تُلهم .. مشاريعُ تُحْدِثُ الأثر
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-100 font-medium">
                    نُمَكِّنُ المؤسسات من إطلاق فرصٍ تطوعية تُحَقِّقُ التغيير المجتمعي،
                    <br class="hidden md:block">
                    ونُسَخِّرُ المنصة لربطها بأشخاصٍ مُلهمين يسعون لبناء المستقبل.
                </p>
                <p class="text-lg md:text-xl text-gray-200 mt-4">
                    معًا نحو مجتمعٍ أكثر تماسكًا وتأثيرًا
                </p>
            </div>
        </div>
    </section>

    <!-- قسم المؤسسات -->
    <div class="flex flex-col my-4 mx-8 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
                <!-- فلترة حسب القطاع -->
                <div class="w-full md:w-1/3 space-y-1">
                    <label for="organization-sector-filter" class="block text-sm font-medium text-gray-700">
                        فلترة حسب القطاع
                    </label>
                    <div class="relative">
                        <select
                            id="organization-sector-filter"
                            wire:model.live="selectedSector"
                            class="w-full py-2 px-3 text-sm rounded-md border border-gray-300 focus:ring-1 focus:ring-secondary/30 focus:outline-none text-gray-700 bg-white transition-all"
                        >
                            <option value="">كل القطاعات</option>
                            @foreach($sectors as $sector)
                                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- بحث المؤسسات -->
                <div class="w-full md:w-2/3 space-y-1">
                    <label for="organization-search" class="block text-sm font-medium text-gray-700">
                        بحث المؤسسات
                    </label>
                    <div class="relative">
                        <!-- Search Icon -->
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>

                        <!-- Search Input -->
                        <input
                            id="organization-search"
                            type="text"
                            placeholder="ابحث باسم المؤسسة..."
                            wire:model.live.debounce.300ms="searchText"
                            class="w-full pr-10 py-2 px-3 text-sm rounded-md border border-gray-300 focus:ring-1 focus:ring-secondary/30 focus:outline-none placeholder-gray-400 transition-all"
                        />

                        <!-- Clear Button -->
                        @if($searchText)
                            <button
                                wire:click="$set('searchText', '')"
                                class="absolute left-3 inset-y-0 flex items-center text-gray-400 hover:text-gray-600 transition cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Helper Text -->
            <p class="text-xs text-gray-500 mt-2">
                يمكنك البحث باسم المؤسسة أو تحديد القطاع لتصفية النتائج
            </p>
        </div>
    </div>

    @if($organizations->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 ">
                @foreach($organizations as $organization)
                    <div class="bg-white shadow-sm rounded-md overflow-hidden border border-gray-100 transition-shadow duration-300">
                        <!-- Organization Image -->
                        <div class="h-40 bg-gray-100 flex items-center justify-center overflow-hidden">
                            @if($organization->user->img_url)
                                <img src="{{ asset($organization->user->img_url) }}" alt="{{ $organization->name }}" class="w-full h-full object-cover">
                            @else
                                <img class="h-full w-full object-cover"
                                     src="https://ui-avatars.com/api/?name={{ urlencode($organization->name) }}&background=random&color=fff"
                                     alt="صورة المؤسسة">
                            @endif
                        </div>

                        <div class="p-5 space-y-4">
                            <div class="flex flex-row justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $organization->name }}</h2>
                                    <div class="mt-2 space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $organization->city->name }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            {{ $organization->sector->name }}
                                        </div>
                                        @if($organization->phone_number)
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                {{ $organization->phone_number }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($organization->bio)
                                <div class="pt-2">
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $organization->bio }}</p>
                                </div>
                            @endif

                            <div class="pt-4 flex space-x-3">
                                <a href="{{ route('organizations.show' , $organization->id) }}"
                                   wire:navigate.keep
                                   class="flex-1 text-center px-4 py-2 btn-primary cursor-pointer">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <div class="bg-primary/10 border-l-4 border-secondaryLight p-4 mb-4">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="font-bold text-primary">لا توجد نتائج بحث</p>
                            <p class="text-primary/90">لم يتم العثور على مؤسسات بإسم "{{ $searchText }}"</p>
                        </div>
                    </div>
                    <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                        عرض جميع المؤسسات
                    </button>
                </div>
            </div>
        @endif

        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $organizations->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

