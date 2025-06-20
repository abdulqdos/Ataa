<div>

    <x-layouts.header title="الطلبات"
                      :breadcrumbs="[
                      ['الرئيسية', route('organization.dashboard')],
                      ['إدارة الطلبات', route('organization.opportunities-requests')],
                      ['الطلبات']]">
    </x-layouts.header>

    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg px-3 py-4 bg-white mx-2 md:mx-5">
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
                           placeholder="ابحث عن  متطوع معين...">
                </div>
            </div>
        </div>

        <div>
            @if($requests->count() > 0)
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            اسم المتطوع
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            السبب
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden sm:table-cell">
                                            الحالة
                                        </th>
                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                            العملية
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($requests as $request)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                                    <a href="#" class="font-medium text-gray-900 hover:text-primaryLight transition duration-300">
                                                        {{ $request->volunteer->first_name . ' ' . $request->volunteer->last_name   }}
                                                    </a>
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                                    <a href="#" class="font-medium text-gray-900 hover:text-primaryLight transition duration-300">
                                                        {{ $request->reason }}
                                                    </a>
                                            </td>

                                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                {{ $request->status }}
                                            </td>
                                            <td class="px-3 py-4 flex flex-row gap-2 md:gap-4 items-center justify-center md:px-6">

                                                @if($request->status !== 'pending')
                                                    <div class="flex flex-row gap-2 bg-green-50 text-green-500 items-center px-3 py-1 rounded-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span> تم توثيق</span>
                                                    </div>
                                                @else
                                                    <a href="{{ route('organization.opportunities-requests.requests.create' , ['opportunity' => $request->opportunity->id , 'request' => $request->id]) }}" class="group flex flex-col items-center justify-center cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 group-hover:text-blue-700 group-hover:cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="text-blue-600 group-hover:text-blue-700 group-hover:cursor-pointer">توثيق</span>
                                                    </a>
                                                @endif
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
                @if( (!empty($searchText)))
                    <div class="text-center py-10">
                        <div class="bg-primary/10 border-l-4 border-secondaryLight p-4 mb-4">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-6 h-6 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="font-bold text-primary">لا توجد نتائج بحث</p>
                                    <p class="text-primary/90">لم يتم العثور على متطوعون بإسم "{{ $searchText }}"</p>
                                </div>
                            </div>
                            <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                                عرض جميع الطلبات
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-primary/20 border border-secondaryLight rounded-xl p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-3 text-lg font-medium text-gray-800">لا يوجد طلبات حاليا</h3>
                        <p class="mt-1 text-sm text-gray-600">لا يوجد طلبات لي هاذي الفرصة ..</p>
                    </div>
                @endif
            @endif
        </div>
        <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
            {{ $requests->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
        </div>
    </div>
</div>
