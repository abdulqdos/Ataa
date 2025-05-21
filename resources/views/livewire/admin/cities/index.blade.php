<div>
    <x-layouts.header title="المدن"
                      :breadcrumbs="[['الرئيسية', route('admin.dashboard')], ['إدارة المدن']]">
        <a href="#" wire:navigate class="px-4 py-1 btn-primary">
            + إضافة مدينة جديد
        </a>
    </x-layouts.header>

    <div class="flex flex-col m-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <!-- Search Section -->
            <div class="space-y-2">
                <label for="sector-search" class="block text-sm font-medium text-gray-700">
                    بحث المدن
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
                        id="sector-search"
                        type="text"
                        placeholder="ابحث باسم المدن..."
                        wire:model.live.debounce.300ms="searchText"
                        class="w-full pr-10 py-2 px-3 text-sm rounded-md border border-gray-300  focus:ring-1 focus:ring-secondary/30 focus:outline-none placeholder-gray-400 transition-all"
                    />

                    <!-- Clear Button (appears when there's text) -->
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

                <!-- Helper Text -->
                <p class="text-xs text-gray-500">
                    ابدأ بكتابة اسم المدينة للبحث المباشر
                </p>
            </div>
        </div>

        @if($cities->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 ">
                @foreach($cities as $city)
                    <div class="bg-white shadow-sm rounded-md  overflow-hidden border border-gray-100  transition-shadow duration-300">
                        <div class="p-5 space-y-4">
                            <div class="flex flex-row justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">{{ $city->name }}</h2>
                                    <div class="flex items-center mt-2 space-x-4 text-sm text-gray-600">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        {{ $city->organizations->count() }} مؤسسة
                                    </span>
                                        <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        {{ $city->opportunities->count() }} فرصة
                                    </span>
                                    </div>
                                </div>
                                <a href="#" class="text-gray-400 hover:text-primary transition-colors duration-200 p-1 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </div>

                            <div class="pt-4 flex space-x-3">
                                <a href="#"
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
                            <p class="text-primary/90">لم يتم العثور على المدن بإسم"{{ $searchText }}"</p>
                        </div>
                    </div>
                    <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                        عرض جميع المدن
                    </button>
                </div>
            </div>
        @endif

        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $cities->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
