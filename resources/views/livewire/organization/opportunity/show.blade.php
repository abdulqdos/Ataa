<div>
    <x-layouts.header title="تفاصيل الفرصة"
                      :breadcrumbs="[
                      ['الرئيسية', route('organization.dashboard')],
                      ['الفرص التطوعية', route('organization.opportunity')],
                      ['تفاصيل الفرصة']]">
    </x-layouts.header>


    <div class="flex justify-center items-center w-2/3 my-4">
        <div class="flex rounded-lg transition p-1 bg-white">
            <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm text-gray-500 hover:text-primary hover:bg-gray-50 cursor-pointer focus:outline-hidden  font-medium rounded-lg  disabled:opacity-50 disabled:pointer-events-none  {{ $activeTab === 'requests' ? 'text-primary bg-gray-50' : '' }}" wire:click="setActiveTab('requests')" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
                    طلبات
                </button>
                <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm text-gray-500 hover:text-primary hover:bg-gray-50 cursor-pointer focus:outline-hidden  font-medium rounded-lg  disabled:opacity-50 disabled:pointer-events-none  {{ $activeTab === 'volunteers' ? 'text-primary bg-gray-50' : '' }}" wire:click="setActiveTab('volunteers')" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
                    المتطوعون المقبولون
                </button>
            </nav>
        </div>
    </div>


    <div class="w-full flex flex-col lg:flex-row gap-4 md:gap-6 my-2">
        @if($modalType)
            <div class="bg-black/10 fixed top-0 right-0 left-0 z-50 flex items-center justify-center w-full h-screen">
                <div class="relative p-4 w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <button type="button" wire:click="setModel(null)" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center cursor-pointer">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto mb-4 text-gray-700 w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-700">{{ $modalType === 'accepted' ? 'هل أنت من قبول المتطوع ؟' : 'هل أنت من رفض الطلب ؟' }}</h3>
                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none focus:z-10 btn-secondary" wire:click="setModel(null)">لا , إلغاء</button>
                            <button data-modal-hide="popup-modal" type="button" class="text-white font-medium text-sm inline-flex items-center px-5 py-2.5 text-center {{ $modalType === 'accepted' ? 'btn-primary' : 'btn-red' }}" wire:click="updateRequestStatus('{{ $modalType }}')">
                                نعم , {{ $modalType === 'accepted' ? 'قبول المتطوع' : 'رفض الطلب' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Requests or Volunteer Section -->
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            @if($activeTab === 'requests')

                <!-- Requests Table -->
                @if($status === 'completed')
                    <div class="flex items-center justify-between p-4  text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
                        <div class="flex flex-row items-center gap-4">
                            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div>
                                <span class="font-medium">عذراً</span>هاذي الفرصة مكتلمه !
                            </div>
                        </div>
                    </div>
                @else
                <!-- Requests Header with Filter -->
                <div class="w-full bg-white rounded-md shadow-sm flex flex-col md:flex-row justify-between items-center p-4 gap-4 md:gap-0">
                    <div class="w-full md:w-auto flex flex-col md:flex-row gap-4 items-center justify-between">
                        <!-- Status Filter -->
                        <select
                            class="w-full md:w-auto border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            wire:model.live="filterStatus"
                        >
                            <option value="">كل الحالات</option>
                            <option value="pending">قيد الانتظار</option>
                            <option value="accepted">مقبول</option>
                            <option value="declined">مرفوض</option>
                        </select>

                        <!-- Required Count -->
                        <p class="text-sm font-medium whitespace-nowrap">العدد المطلوب: {{ $opportunity->count - $opportunity->accepted_count }}</p>
                    </div>
                </div>
                    @if($requests->count() > 0)
                        <div class="flex flex-col bg-white">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="text-xs uppercase">
                                            <tr>
                                                <th scope="col" class="px-4 py-3 text-center whitespace-nowrap">إسم المتطوع</th>
                                                <th scope="col" class="px-4 py-3 text-center hidden sm:table-cell">وصف الفرصة</th>
                                                <th scope="col" class="px-4 py-3 text-center whitespace-nowrap">الحالة</th>
                                                <th scope="col" class="px-4 py-3 text-center whitespace-nowrap">العملية</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($requests as $request)
                                                <tr class="bg-white hover:bg-gray-50 border-b">
                                                    <td class="px-4 py-3 max-w-[120px] text-xs text-center sm:text-right">
                                                        <a href="#" class="font-medium"> {{ $request->volunteer->first_name . ' ' . $request->volunteer->last_name }} </a>
                                                    </td>
                                                    <td class="px-4 py-3 text-xs max-w-[150px] hidden sm:table-cell">
                                                        <p class="truncate"> {{ $request->reason }} </p>
                                                    </td>

                                                    <td class="px-2 py-3 text-center">
                                                        <span class="px-2 py-1 text-xs font-semibold rounded-md whitespace-nowrap
                                                            @if($request->status == 'accepted') bg-green-100 text-green-600
                                                            @elseif($request->status == 'pending') bg-yellow-100 text-yellow-600
                                                            @else bg-red-100 text-red-600 @endif">
                                                            @if($request->status === 'accepted')
                                                                مقبول
                                                            @elseif($request->status === 'pending')
                                                                قيد الانتظار
                                                            @elseif($request->status === 'declined')
                                                                مرفوض
                                                            @endif
                                                        </span>
                                                    </td>

                                                    <td class="px-2 py-3 flex flex-col sm:flex-row gap-2 text-sm justify-center items-center">
                                                        @if($request->status == 'accepted' || $request->status == 'declined')
                                                            <a href="{{ route('organization.volunteers.show' , $request->volunteer->id) }}" class="w-full sm:w-auto text-center px-2 py-1 btn-yellow text-xs sm:text-sm">عرض بيانات المتطوع</a>
                                                        @else
                                                            <a href="{{ route('organization.requests.show' , $request->id) }}" class="w-full sm:w-auto text-center px-2 py-1 btn-yellow text-xs sm:text-sm">مراجعة</a>
                                                            <button type="button" class="w-full sm:w-auto text-center px-2 py-1 btn-primary text-xs sm:text-sm" wire:click="setModel('accepted' , {{ $request->id }})">قبول</button>
                                                            <button type="button" class="w-full sm:w-auto text-center px-2 py-1 btn-secondary text-xs sm:text-sm" wire:click="setModel('declined',{{ $request->id }})">رفض</button>
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

                        <!-- Pagination -->
                        <div class="my-2 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                            {{ $requests->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
                        </div>

                    @else
                        <div class="flex items-center justify-between p-4 mb-4 my-6 lg:my-10 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
                            <div class="flex flex-row items-center gap-4">
                                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <div>
                                    <span class="font-medium">عذراً</span>
                                    لم يتم تقديم أي طلبات
                                    @if($filterStatus)
                                        <span class="font-semibold"> "{{ match($filterStatus) {
                                                        'pending' => 'قيد الانتظار',
                                                        'accepted' => 'مقبول',
                                                        'declined' => 'مرفوض',
                                                        default => '' }
                                                    }}"
                                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @else
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

                    </div>

                    <div>
                        @if($volunteers->count() > 0)
                            <div class="flex flex-col">
                                <div class="-m-1.5 overflow-x-auto">
                                    <div class="p-1.5 min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                                        اسم مستخدم
                                                    </th>
                                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                                        رقم الهاتف
                                                    </th>
                                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6 hidden md:table-cell">
                                                        العمر
                                                    </th>
                                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                                        الجنس
                                                    </th>
                                                    @if($status == 'completed')
                                                        <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                                            العملية
                                                        </th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                @foreach($volunteers as $volunteer)
                                                    <tr class="hover:bg-gray-50 text-center">
                                                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                                            <div class="flex flex-row items-center gap-2 justify-start">
                                                                @if($volunteer->img_url === null)
                                                                    <img class="h-6 w-6 rounded-md" src="https://ui-avatars.com/api/?name={{ $volunteer->user->user_name }}&background=random&color=fff" alt="صورة المؤسسة">
                                                                @else
                                                                    <img class="h-6 w-6 rounded-md" src="{{ \Illuminate\Support\Facades\Storage::url($volunteer->img_url) }}" alt="صورة المؤسسة">
                                                                @endif
                                                                <a href="{{ route('organization.volunteers.show' , $volunteer->id) }}" class="font-medium text-gray-900 hover:text-primaryLight transition duration-300">
                                                                    {{ $volunteer->first_name . ' ' . $volunteer->last_name }}
                                                                </a>
                                                            </div>
                                                        </td>

                                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                            {{ $volunteer->phone_number }}
                                                        </td>

                                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 hidden md:table-cell md:px-6">
                                                            {{ $volunteer->age }}
                                                        </td>

                                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                                            {{ $volunteer->gender }}
                                                        </td>

                                                        @if($status == 'completed')
                                                            <td class="px-3 py-4 flex flex-row gap-2 md:gap-4 items-center justify-center md:px-6">

                                                                @if($volunteer->pivot->hours !== null)
                                                                    <div class="flex flex-col  text-green-500 items-center px-3 py-1 rounded-full">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                        <span class="text-sm"> تم توثيق</span>
                                                                    </div>
                                                                @else

                                                                    <a href="{{ route('organization.volunteers.documentation.create' , ['opportunity' => $opportunity->id , 'volunteer' => $volunteer->id]) }}" class="group flex flex-col items-center justify-center cursor-pointer">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 group-hover:text-blue-700 group-hover:cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                        </svg>
                                                                        <span class="text-blue-600 group-hover:text-blue-700 group-hover:cursor-pointer">توثيق</span>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        @endif
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
                                                <p class="text-primary/90">لم يتم العثور على فرص تطابق "{{ $searchText }}"</p>
                                            </div>
                                        </div>
                                        <button wire:click="clear()" class="mt-3 px-4 py-2 btn-primary">
                                            عرض جميع المتطوعون
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
                                        <button wire:click="setActiveTab('requests')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md btn-primary">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span class="mr-2"> عرض طلبات </span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                        {{ $volunteers->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
                    </div>
                </div>
            @endif

        </div>

        <!-- Opportunity Details -->
        <div class="w-full lg:w-1/3 bg-white shadow-md rounded-md overflow-hidden flex flex-col gap-4 order-first lg:order-none">
            <!-- Opportunity Image -->
            <div class="w-full h-48">
                @if($this->opportunity->img_url === null)
                    <img class="w-full h-full object-cover"
                         src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff"
                         alt="">
                @else
                    <img class="w-full h-full object-cover"
                         src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}"
                         alt="">
                @endif
            </div>

            <!-- Opportunity Details -->
            <div class="p-4 flex flex-col gap-3">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h2 class="text-lg md:text-xl text-gray-800 font-bold"> {{ $opportunity->title }}</h2>
                    <x-layouts.status-opportunity :opportunity="$opportunity" />
                </div>

                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    {{ $opportunity->description }}
                </p>

                <!-- Start and End Dates -->
                <div class="flex flex-col gap-2 text-gray-700 text-sm">
                    <div class="flex flex-row gap-x-3">
                        <span class="font-bold whitespace-nowrap">تاريخ البداية:</span>
                        <span>{{ \Carbon\Carbon::parse($opportunity->start_date)->format('Y-m-d') }}</span>
                    </div>
                    <div class="flex flex-row gap-x-3">
                        <span class="font-bold whitespace-nowrap">تاريخ النهاية:</span>
                        <span>{{ \Carbon\Carbon::parse($opportunity->end_date)->format('Y-m-d') }}</span>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex flex-row gap-x-3 text-gray-700 text-sm">
                    <span class="font-bold whitespace-nowrap">الموقع:</span>
                    @if($opportunity->location_url !== null)
                        <a href="{{ $opportunity->location_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline truncate">{{ $opportunity->location }}</a>
                    @else
                        <span class="truncate">{{ $opportunity->location }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
