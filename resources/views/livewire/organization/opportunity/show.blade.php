<div>
    <x-layouts.header title="الطلبات"
                      :breadcrumbs="[
                      ['الرئيسية', route('organization.dashboard')],
                      ['الفرص التطوعية', route('organization.opportunity')],
                      ['الطلبات']]">
    </x-layouts.header>

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

        <!-- Requests Section -->
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            <!-- Requests Header with Filter -->
            <div class="w-full bg-white rounded-md shadow-md flex flex-col md:flex-row justify-between items-center p-4 gap-4 md:gap-0">
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

            <!-- Requests Table -->
            @if($requests->count() > 0)
                <div class="w-full bg-white rounded-md shadow-md overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                        <thead class="text-xs bg-gray-900 uppercase text-white">
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
                                        <a href="#" class="w-full sm:w-auto text-center px-2 py-1 btn-yellow text-xs sm:text-sm">عرض بيانات المتطوع</a>
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

                    <span class="px-3 py-1 text-xs sm:text-sm font-semibold rounded-md text-center
                   @if($opportunity->start_date <= now() && $opportunity->end_date >= now()) bg-green-100 text-green-500
                    @elseif($opportunity->end_date < now()) bg-blue-100 text-blue-500
                    @elseif($opportunity->start_date > now()) bg-yellow-100 text-yellow-600 @endif">
                    @if($opportunity->start_date <= now() && $opportunity->end_date >= now() )
                            نشط
                        @elseif($opportunity->start_date > now() )
                            قريباً
                        @elseif($opportunity->end_date < now() )
                            مكتملة
                        @endif
                    </span>
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
