<div>
    @if($showDeleteBox)
        <div class="bg-black/10 fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-screen">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button" wire:click="resetDeleteBox" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-700 w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-700">هل أنت متأكد من حذف الفرصة التطوعية ؟</h3>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none bg-[var(--darkGray)] hover:bg-[var(--lightGray)] transition duration-300 rounded-md focus:z-10 cursor-pointer" wire:click="resetDeleteBox">لا , إلغاء </button>
                        <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 transition duration-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center cursor-pointer" wire:click="confirmDelete">
                            نعم , أنا متأكد
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="max-w-full mx-10 px-4 py-2 mb-4 bg-white shadow-md rounded-md">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-xl px-1 py-2 text-[var(--primary)]"> فرص التطوعية </h1>
            <a href="{{ route('organization.opportunity.create') }}" wire:navigate class="bg-[var(--primary)] px-4 py-1 cursor-pointer hover:bg-[var(--primaryLight)] transition duration-300 text-white rounded-md">
                + إضافة فرصة جديدة
            </a>
        </div>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-3 py-1 bg-white mx-10">
        <div class="py-4 bg-white flex flex-row items-center justify-start gap-4">
            <!-- مربع البحث -->
            <div>
                <label for="table-search" class="sr-only">بحث</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                           wire:model.live="searchText"
                           class="block py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)]"
                           placeholder="ابحث عن فرصة معينة...">
                </div>
            </div>

            <!-- البحث بالتاريخ -->
            <div class="flex gap-4">
                <!-- تاريخ البداية -->
                <div class="w-44 flex flex-row gap-4 items-center">
                    <label for="start_date" class="block text-sm font-medium text-gray-600">تاريخ البداية</label>
                    <input type="date" id="start_date" name="start_date"
                           class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)]"
                           wire:model.live="start_date">
                </div>

                <!-- تاريخ النهاية -->
                <div class="w-44 flex flex-row gap-6 items-center mr-5">
                    <label for="end_date" class="block text-sm font-medium text-gray-600">تاريخ النهاية</label>
                    <input type="date" id="end_date" name="end_date"
                           class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)]"
                           wire:model.live="end_date">
                </div>
            </div>

            <!-- البحث بالحالة -->
            <div class="w-44 flex flex-row gap-6 items-center mr-5">
                <label for="status" class="block text-sm font-medium text-gray-600">الحالة</label>
                <select id="status" name="status"
                        class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                focus:ring-1 focus:outline-none focus:ring-[var(--secondaryLight)] focus:border-[var(--secondaryLight)]"
                        wire:model.live="status">
                    <option value="">جميع الحالات</option>
                    <option value="available">متاحة</option>
                    <option value="ongoing">مستمرة</option>
                    <option value="completed">مكتملة</option>
                </select>
            </div>
        </div>


        <div>
            @if($opportunities->count() > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-900 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            عنوان االفرصة
                        </th>
                        <th scope="col" class="px-6 py-3">
                            وصف الفرصة
                        </th>
                        <th scope="col" class="px-6 py-3">
                            تاريخ البداية
                        </th>
                        <th scope="col" class="px-6 py-3">
                            تاريخ النهاية
                        </th>
                        <th scope="col" class="px-10 py-3">
                            الحالة
                        </th>
                        <th scope="col" class="px-6 py-3">
                            العملية
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($opportunities as $opportunity)
                            <tr class="bg-white  hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $opportunity->title }}
                                </th>
                                <td class="px-6 py-4 truncate ... max-w-[150px]">
                                    {{ $opportunity->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($opportunity->end_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-semibold text-center
                                        @if($opportunity->status == 'ongoing')
                                            text-blue-600 border border-blue-600 bg-white
                                        @elseif($opportunity->status == 'completed')
                                            text-green-600 border border-green-600 bg-white
                                        @elseif($opportunity->status == 'available')
                                            text-yellow-600 border border-yellow-600 bg-white
                                        @endif
                                        px-1 py-1 mx-0 rounded-md text-sm">
                                        @if($opportunity->status == 'ongoing')
                                            مستمرة
                                        @elseif($opportunity->status == 'completed')
                                            مكتملة
                                        @elseif($opportunity->status == 'available')
                                            متاحة
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex flex-row gap-4">
                                    <a href="{{ route('organization.opportunity.edit' , $opportunity->id) }}" class="font-medium bg-blue-600 px-4 py-1 text-white cursor-pointer hover:bg-blue-800 transition duration-300 rounded-md">Edit</a>
                                    <button wire:click="toggleShowDeleteBox({{ $opportunity->id }})" class="font-medium bg-red-600  px-4 py-1 text-white cursor-pointer hover:bg-red-800 transition duration-300 rounded-md">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="flex items-center justify-between p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
                    <div class="flex flex-row items-center gap-4">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                            <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                            </svg>
                            عرض كل الفرص التطوعية
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>


</div>
