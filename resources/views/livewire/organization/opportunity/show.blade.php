<div class="w-full flex flex-row gap-x-6 my-10">

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


    <!-- Requests -->
    <div class="w-2/3 flex flex-col gap-y-4 items-center">
        <!-- عنوان الطلبات مع البحث والفلترة -->
        <div class="w-full bg-white rounded-md mx-4 shadow-md flex flex-row justify-between items-center px-4 py-2">
            <h2 class="text-xl font-semibold">الطلبات</h2>
            <div class="flex flex-row gap-4 items-center">

                <!-- فلترة حسب الحالة -->
                <select
                    class="border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:model.live="filterStatus"
                >
                    <option value="">كل الحالات</option>
                    <option value="pending">قيد الانتظار</option>
                    <option value="accepted">مقبول</option>
                    <option value="declined">مرفوض</option>
                </select>

                <!-- العدد المطلوب -->
                <p class="text-sm font-medium">العدد المطلوب: {{ $opportunity->count - $opportunity->accepted_count }}</p>
            </div>
        </div>

        <!-- جدول الطلبات (يبقى كما هو) -->
        @if($requests->count() > 0)
            <div class="w-full bg-white rounded-md shadow-md overflow-hidden">
                <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                    <thead class="text-xs bg-gray-900 uppercase text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">إسم المتطوع </th>
                            <th scope="col" class="px-6 py-3 text-center">وصف الفرصة</th>
                            <th scope="col" class="px-12 py-3 text-center">الحالة</th>
                            <th scope="col" class="px-6 py-3 text-center">العملية</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr class="bg-white hover:bg-gray-50">
                            <th class="px-6 py-4 max-w-[150px] text-xs">
                                <a href="#"> {{ $request->volunteer->first_name . ' ' . $request->volunteer->last_name }} </a>
                            </th>
                            <th class="px-8 py-4 text-xs max-w-[150px]">
                                <p> {{ $request->reason }} </p>
                            </th>

                            <td class="px-4 py-2">
                                <span class="px-3 py-1 text-xs font-semibold rounded-md
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

                            <td class="px-6 py-4 flex flex-row gap-4 text-sm justify-center items-center">
                                @if($request->status == 'accepted' || $request->status == 'declined')
                                    <a href="#"  class="font-medium px-4 py-1 btn-yellow">عرض بيانات المتطوع</a>
                                @else
                                    <a href="{{ route('organization.requests.show' , $request->id) }}"  class="font-medium px-4 py-1 btn-yellow">مراجعة</a>
                                    <button type="button" class="font-medium px-4 py-1 btn-primary" wire:click="setModel('accepted' , {{ $request->id }})">قبول</button>
                                    <button type="button" class="font-medium px-4 py-1 btn-secondary" wire:click="setModel('declined',{{ $request->id }})">رفض</button>
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



    <!-- opportunity -->
    <div class="bg-white w-1/3 shadow-md transition rounded-md overflow-hidden flex flex-col gap-4">
        <!-- صورة الفرصة -->
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

        <!-- تفاصيل الفرصة -->
        <div class="p-4 flex flex-col gap-3">
            <div class="flex flex-row items-center justify-between">
                <h2 class="text-lg md:text-xl text-gray-800 font-bold"> {{ $opportunity->title }}</h2>

                <span class="px-3 py-1 text-sm font-semibold rounded-md text-center
                @if($opportunity->status == 'active') bg-green-100 text-green-600
                @elseif($opportunity->status == 'completed') bg-blue-100 text-blue-600
                @else bg-yellow-100 text-yellow-700 @endif">
                @if($opportunity->status === 'active')
                        نشط
                    @elseif($opportunity->status === 'upcoming')
                        قريباً
                    @elseif($opportunity->status === 'completed')
                        مكتملة
                    @endif
            </span>
            </div>

            <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                {{ $opportunity->description }}
            </p>

            <!-- تاريخ البداية والنهاية -->
            <div class="flex flex-col gap-2 text-gray-700 text-sm">
                <div class="flex flex-row gap-x-3">
                    <span class="font-bold">تاريخ البداية:</span>
                    <span>{{ \Carbon\Carbon::parse($opportunity->start_date)->format('Y-m-d') }}</span>
                </div>
                <div class="flex flex-row gap-x-3">
                    <span class="font-bold">تاريخ النهاية:</span>
                    <span>{{ \Carbon\Carbon::parse($opportunity->end_date)->format('Y-m-d') }}</span>
                </div>
            </div>

            <!-- الموقع -->
            <div class="flex flex-row gap-x-3 text-gray-700 text-sm ">
                <span class="font-bold">الموقع:</span>
                @if($opportunity->location_url !== null)
                    <a href="{{ $opportunity->location_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">{{ $opportunity->location }}</a>
                @else
                    <span>{{ $opportunity->location }}</span>
                @endif
            </div>
        </div>
    </div>

</div>
