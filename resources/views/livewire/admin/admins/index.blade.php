<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-layouts.header title="المشرفون"
                      :breadcrumbs="[['الرئيسية', route('admin.dashboard')], ['إدارة المشرفون']]">
        <a href="#" wire:navigate class="px-4 py-1 btn-primary">
            + إضافة مشرف جديد
        </a>
    </x-layouts.header>

    <div class="flex flex-col m-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <!-- Search Section -->
            <div class="space-y-2">
                <label for="sector-search" class="block text-sm font-medium text-gray-700">
                    بحث عن مشرف معين
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
                        placeholder="ابحث باسم الشؤف..."
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

        @if($admins->count() > 0)
            @foreach($admins as $admin)
                <p> {{ $admin->user_name }}</p>
            @endforeach
        @else
            <div class="text-center py-10">
                <div class="bg-primary/10 border-l-4 border-secondaryLight p-4 mb-4">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="font-bold text-primary">لا توجد نتائج بحث</p>
                            <p class="text-primary/90">لم يتم العثور على المشرفون بإسم"{{ $searchText }}"</p>
                        </div>
                    </div>
                    <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                        عرض جميع المشرفون
                    </button>
                </div>
            </div>
        @endif

        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $admins->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
