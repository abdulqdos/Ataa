<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <x-layouts.header title="المشرفون"
                      :breadcrumbs="[['الرئيسية', route('admin.dashboard')], ['إدارة المشرفون']]">
        <a href="{{ route('admin.admins.create') }}" wire:navigate class="px-4 py-1 btn-primary">
            + إضافة مشرف جديد
        </a>
    </x-layouts.header>

    @if($showDeleteBox)
        <div class="bg-black/10 fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-screen">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" wire:click="resetDeleteBox" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-700 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-700">هل أنت متأكد من حذف المشرف ؟</h3>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none  focus:z-10 btn-secondary" wire:click="resetDeleteBox">لا , إلغاء </button>
                        <button data-modal-hide="popup-modal" type="button" class="text-white font-medium text-sm inline-flex items-center px-5 py-2.5 text-center  btn-red" wire:click="confirmDelete">
                            نعم , أنا متأكد
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-col m-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mx-2 md:mx-5">
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
        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg  py-4 bg-white mx-2 md:mx-5">
            @if($admins->count() > 0)
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            إسم مستخدم
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden sm:table-cell">
                                            الايميل
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            العملية
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($admins as $admin)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                                {{ $admin->user_name }}
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 truncate max-w-[150px] hidden sm:table-cell md:px-6">
                                                {{ $admin->email }}
                                            </td>

                                            <td class="px-3 py-4 flex flex-row gap-2 md:gap-4 items-center justify-center md:px-6">

                                                <a href="{{ route('admin.admins.edit' , $admin->id) }}" class="group font-medium px-2 md:px-4 py-1 flex flex-col items-center gap-1 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-green-500 group-hover:text-green-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                                    </svg>
                                                    <span class="text-xs text-green-500 group-hover:text-green-600 transition">Edit</span>
                                                </a>

                                                <button wire:click="toggleShowDeleteBox({{ $admin->id }})" class="group font-medium px-2 md:px-4 py-1 flex flex-col gap-1 items-center cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2m12 0H5" />
                                                    </svg>
                                                    <span class="text-xs text-red-500 group-hover:text-red-600 transition">Delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
                                <p class="text-primary/90">لم يتم العثور على المشرفون بإسم"{{ $searchText }}"</p>
                            </div>
                        </div>
                        <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                            عرض جميع المشرفون
                        </button>
                    </div>
                </div>
            @endif
        </div>


        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $admins->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
