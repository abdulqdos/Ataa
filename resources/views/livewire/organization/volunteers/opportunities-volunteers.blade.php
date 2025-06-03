<div>

    <x-layouts.header title="إدارة المتطوعون"
                      :breadcrumbs="[['الرئيسية', route('organization.dashboard')], ['إدارة المتطوعون']]">
    </x-layouts.header>
    <div class="container lg:px-24 py-3">
        <!-- Search && Filter Section -->
        <div id="top" class="bg-white rounded-xl shadow-sm p-5 transition-all duration-300 rtl" dir="rtl">
            <div class="flex flex-col gap-4">
                <!-- Search and Filter Row -->
                <div class="flex flex-col md:flex-row gap-4 items-stretch">
                    <!-- Search Box -->
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            placeholder="ابحث عن فرصة تطوعية..."
                            wire:model.live="searchText"
                            class="w-full pr-10 py-2.5 px-4 text-sm rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none placeholder-gray-400 transition"
                        />
                    </div>

                    <!-- Status Filter -->
                    <div class="relative min-w-[160px]">
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                            </svg>
                        </div>
                        <select
                            class="w-full text-sm appearance-none pr-10 py-2.5 px-4 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none bg-white cursor-pointer transition"
                            wire:model.live="status">
                            <option value="">كل الحالات</option>
                            <option value="upcoming">قريباً</option>
                            <option value="active">نشطة</option>
                            <option value="completed">مكتملة</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @if($opportunities->count() > 0)
            <!-- Volunteer Opportunities Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
                @foreach($opportunities as $opportunity)
                    <div class="bg-white rounded-md shadow-md overflow-hidden border border-gray-100  transition-all duration-300 h-full flex flex-col group">
                        <!-- Image Section -->
                        <div class="h-52 overflow-hidden relative">
                            @if($opportunity->img_url === null)
                                <a href="{{  route('organization.opportunity.show' , $opportunity->id ) }}">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500 cursor-pointer"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff"
                                         alt="صورة المؤسسة">
                                </a>

                            @else
                                <a href="{{ route('organization.opportunity.show' , $opportunity->id) }}">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition duration-500 cursor-pointer"
                                         src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}"
                                         alt="صورة المؤسسة">
                                </a>

                            @endif
                            <div class="absolute bottom-0 left-0 right-0 h-1/3 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-5 flex-1 flex flex-col">
                            <!-- Title and Status -->
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-xl font-bold text-gray-800 line-clamp-1">{{ $opportunity->title }}</h2>
                                <x-layouts.status-opportunity :opportunity="$opportunity" />
                            </div>

                            <!-- Opportunity Details -->
                            <div class="space-y-3.5 flex-1">
                                <!-- Organization -->
                                <div class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 ml-2 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <span class="text-gray-600 text-sm">{{ $opportunity->organization->name }}</span>
                                </div>

                                <!-- Dates -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 ml-2 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500">تاريخ البدء</p>
                                            <p class="text-sm">{{ \Carbon\Carbon::parse($opportunity->start_date)->format('d-m-Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 ml-2 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500">تاريخ الانتهاء</p>
                                            <p class="text-sm">{{ \Carbon\Carbon::parse($opportunity->end_date)->format('d-m-Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 ml-2 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <a href="{{ $opportunity->location_url }}" class="text-primary hover:underline text-sm" target="_blank">
                                        {{ $opportunity->location }}
                                    </a>
                                </div>

                                <!-- Volunteers Progress -->
                                <div class="pt-3">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1.5">
                                        <span class="text-gray-500">المتطوعين المسجلين</span>
                                        <span class="font-medium">{{ $opportunity->accepted_count }}/{{ $opportunity->count }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full"
                                             style="width: {{ ($opportunity->accepted_count/$opportunity->count)*100 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pt-5 mt-auto">
                                <a href="{{ route('organization.volunteers' , $opportunity->id) }}"
                                   wire:navigate.keep
                                   class="block w-full text-center px-4 py-3 text-sm font-medium rounded-lg
                                   shadow-sm text-white bg-primary hover:bg-primary/90 transition-all
                                   duration-300 cursor-pointer">
                                    عرض المتطوعين
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="my-8 mx-auto flex justify-center">
                {{ $opportunities->links('vendor.pagination.custom') }}
            </div>
        @else
            @if( (!empty($searchText) || !empty($status) ))
                <div class="text-center py-10">
                    <div class="bg-primary/10 border-l-4 border-secondaryLight p-4 mb-4">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <p class="font-bold text-primary">لا توجد نتائج بحث</p>
                                <p class="text-primary/90">لم يتم العثور على فرص تطابق "{{ $searchText }}"</p>
                            </div>
                        </div>
                        <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                            عرض جميع الفرص
                        </button>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-primary/20 border border-secondaryLight rounded-xl p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-3 text-lg font-medium text-gray-800">لا يوجد متطوعون مسجلون حاليا</h3>
                    <p class="mt-1 text-sm text-gray-600">لا يوجد متطوعون لي هاذي الفرصة . يمكنك تحقق من طلبات .</p>
                    <div class="mt-4">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md btn-primary">

                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span class="mr-2"> عرض ا </span>
                        </a>
                    </div>
                </div>
            @endif
            @endif
        @endif
    </div>
</div>
