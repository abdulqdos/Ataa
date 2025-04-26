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

    <x-layouts.header title="الفرص التطوعية"
                      :breadcrumbs="[['الرئيسية', route('organization.dashboard')], ['الفرص التطوعية']]">
        <a href="{{ route('organization.opportunity.create') }}" wire:navigate class="px-4 py-1 btn-primary">
            + إضافة فرصة جديدة
        </a>
    </x-layouts.header>

    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg px-3 py-1 bg-white mx-2 md:mx-5">
        <div class="py-4 bg-white flex flex-col md:flex-row items-start md:items-center justify-start gap-4">
            <!-- Search box -->
            <div class="w-full md:w-auto">
                <label for="table-search" class="sr-only">بحث</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                           wire:model.live="searchText"
                           class="block py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full md:w-80 bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                           placeholder="ابحث عن فرصة معينة...">
                </div>
            </div>

            <!-- Date filters -->
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <!-- Start date -->
                <div class="w-full md:w-44 flex flex-col md:flex-row gap-2 md:gap-4 items-start md:items-center">
                    <label for="start_date" class="block text-sm font-medium text-gray-600">تاريخ البداية</label>
                    <input type="date" id="start_date" name="start_date"
                           class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                           wire:model.live="start_date">
                </div>

                <!-- End date -->
                <div class="w-full md:w-44 flex flex-col md:flex-row gap-2 md:gap-6 items-start md:items-center">
                    <label for="end_date" class="block text-sm font-medium text-gray-600">تاريخ النهاية</label>
                    <input type="date" id="end_date" name="end_date"
                           class="block w-full py-2 px-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                   focus:ring-1 focus:outline-none focus:ring-secondaryLight focus:border-secondaryLight"
                           wire:model.live="end_date">
                </div>
            </div>

            <!-- Status filter -->
            <div class="w-full md:w-44 flex flex-col md:flex-row gap-2 md:gap-6 items-start md:items-center lg:mr-4">
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
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            عنوان الفرصة
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden sm:table-cell">
                                            وصف الفرصة
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            تاريخ البداية
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden md:table-cell">
                                            تاريخ النهاية
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            الحالة
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            العملية
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($opportunities as $opportunity)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                                <div class="flex flex-row items-center gap-2 justify-start">
                                                    @if($opportunity->img_url === null)
                                                        <img class="h-6 w-6 rounded-md" src="https://ui-avatars.com/api/?name={{ $opportunity->title }}&background=random&color=fff" alt="صورة المؤسسة">
                                                    @else
                                                        <img class="h-6 w-6 rounded-md" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="صورة المؤسسة">
                                                    @endif
                                                    <a href="{{ route('organization.opportunity.show' , $opportunity->id) }}" class="font-medium text-gray-900 hover:text-primaryLight transition duration-300">
                                                        {{ Str::limit($opportunity->title, 20) }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 truncate max-w-[150px] hidden sm:table-cell md:px-6">
                                                {{ Str::limit($opportunity->description, 30) }}
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d M Y') }}
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell md:px-6">
                                                {{ \Carbon\Carbon::parse($opportunity->end_date)->format('d M Y') }}
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                <div>
                                                    <x-layouts.status-opportunity :opportunity="$opportunity" />
                                                </div>
                                            </td>

                                            <td class="px-3 py-4 flex flex-row gap-2 md:gap-4 items-center justify-center md:px-6">
                                                <a href="{{ route('organization.opportunity.edit' , $opportunity->id) }}" class="group font-medium px-2 md:px-4 py-1 flex flex-col items-center gap-1 cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6 text-green-500 group-hover:text-green-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                                    </svg>
                                                    <span class="text-xs text-green-500 group-hover:text-green-600 transition">Edit</span>
                                                </a>

                                                <button wire:click="toggleShowDeleteBox({{ $opportunity->id }})" class="group font-medium px-2 md:px-4 py-1 flex flex-col gap-1 items-center cursor-pointer">
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
                @if( (!empty($searchText) || !empty($status) || !empty($start_date) || !empty($end_date) ))
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
                        <h3 class="mt-3 text-lg font-medium text-gray-800">لا توجد فرص مسجلة</h3>
                        <p class="mt-1 text-sm text-gray-600">لا يوجد فرص لي مؤسستك حاليا . يمكنك انشاء فرصة الان .</p>
                        <div class="mt-4">
                            <a href="{{ route('organization.opportunity.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="mr-2"> انشاء فرصة </span>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $opportunities->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
        </div>
    </div>
</div>
