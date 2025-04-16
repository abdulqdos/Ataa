<div>
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
                        <h3 class="mb-5 text-lg font-normal text-gray-700">هل أنت متأكد من حذف الفرصة التطوعية ؟</h3>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium  focus:outline-none  focus:z-10 btn-secondary" wire:click="resetDeleteBox">لا , إلغاء </button>
                        <button data-modal-hide="popup-modal" type="button" class="text-white font-medium text-sm inline-flex items-center px-5 py-2.5 text-center  btn-red" wire:click="confirmDelete">
                            نعم , أنا متأكد
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="max-w-full mx-5 px-4 py-2 mb-4 bg-white shadow-sm rounded-md" id="top">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-xl px-1 py-2 text-primary font-semibold"> فرص التطوعية </h1>
            <a href="{{ route('organization.opportunity.create') }}" wire:navigate class="px-4 py-1 btn-primary">
                + إضافة فرصة جديدة
            </a>
        </div>
    </div>


    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg px-3 py-1 bg-white mx-5">
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
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
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
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                           wire:model.live="start_date">
                </div>

                <!-- تاريخ النهاية -->
                <div class="w-44 flex flex-row gap-6 items-center mr-5">
                    <label for="end_date" class="block text-sm font-medium text-gray-600">تاريخ النهاية</label>
                    <input type="date" id="end_date" name="end_date"
                           class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                           wire:model.live="end_date">
                </div>
            </div>

            <!-- البحث بالحالة -->
            <div class="w-44 flex flex-row gap-6 items-center mr-5">
                <label for="status" class="block text-sm font-medium text-gray-600">الحالة</label>
                <select id="status" name="status"
                        class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                        wire:model.live="status">
                    <option value="">جميع الحالات</option>
                    <option value="upcoming">قريباً</option>
                    <option value="active">نشطة</option>
                    <option value="completed">مكتملة</option>
                </select>
            </div>
        </div>
        <div>
            @if($opportunities->count() > 0)
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                            عنوان االفرصة
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                            وصف الفرصة
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                            تاريخ البداية
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                            تاريخ النهاية
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                            الحالة
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500">
                                            العملية
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($opportunities as $opportunity)

                                        <tr  class="hover:bg-gray-100 text-center">
                                            <th class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                <div class="flex flex-row items-center gap-2 justify-start">
                                                    @if($opportunity->img_url === null)
                                                        <img class="h-6 w-6 rounded-md" src="https://ui-avatars.com/api/?name={{ $opportunity->title }}&background=random&color=fff" alt="صورة المؤسسة">
                                                    @else
                                                        <img class="h-6 w-6 rounded-md" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="صورة المؤسسة">
                                                    @endif
                                                    <a href="{{ route('organization.opportunity.show' , $opportunity->id) }}" class="font-medium text-gray-900 hover:text-primaryLight transition duration-300">
                                                        {{ $opportunity->title }}
                                                    </a>
                                                </div>
                                            </th>
                                            <td  class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 truncate ... max-w-[150px]">
                                                {{ $opportunity->description }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d M Y') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ \Carbon\Carbon::parse($opportunity->end_date)->format('d M Y') }}
                                            </td>


                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                <livewire:opportunity-status :opportunity="$opportunity"  wire:key="{{ $opportunity->id }}"  />
                                            </td>


                                            <td class="px-6 py-4 flex flex-row gap-4 items-center justify-center">
                                                <a href="{{ route('organization.opportunity.edit' , $opportunity->id) }}" class="group font-medium px-4 py-1 flex flex-col items-center gap-1 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 group-hover:text-green-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                                    </svg>
                                                    <span class="text-xs text-green-500 group-hover:text-green-600 transition">Edit</span>
                                                </a>


                                                <button wire:click="toggleShowDeleteBox({{ $opportunity->id }})" class="group font-medium px-4 py-1 flex flex-col gap-1 items-center cursor-pointer">
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
                <div class="flex items-center justify-between p-4 mb-4 my-6 lg:my-10 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
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
        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $opportunities->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
        </div>
    </div>


</div>
