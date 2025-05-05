<div>

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
                            <a href="{{ route('organization.requests.show' , $requestId) }}" data-modal-hide="popup-modal" type="button" class="text-white font-medium text-sm inline-flex items-center px-5 py-2.5 text-center {{ $modalType === 'accepted' ? 'btn-primary' : 'btn-red' }}">
                                نعم , {{ $modalType === 'accepted' ? 'قبول المتطوع' : 'رفض الطلب' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">لوحة التحكم</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 mb-6">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-primary/10 text-primary">
                        <i class="fas fa-hands-helping text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">الفرص التطوعية</h2>
                        <p class="text-2xl font-bold text-primary">{{ $opportunities->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-secondary/10  text-secondary">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">المتطوعون المسجلون</h2>
                        <p class="text-2xl font-bold text-secondary">{{ $volunteers_count->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500/10 text-yellow-500 flex items-center">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">ساعات التطوع</h2>
                        <p class="text-2xl font-bold text-yellow-500">215</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/10 text-blue-500 flex items-center">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <h2 class="text-sm font-medium text-gray-600">طلبات الانضمام</h2>
                        <p class="text-2xl font-bold text-blue-500">{{ $requests_count->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Opportunities -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-medium">أحدث الفرص التطوعية</h2>
                <a href="{{ route('organization.opportunity') }}" class="text-primary hover:text-primaryLight text-sm transition duration-300">عرض الكل</a>
            </div>
            <div class="p-4">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-gray-600 text-sm">
                            <th class="pb-3 pr-4">عنوان الفرصة</th>
                            <th class="pb-3 hidden md:table-cell">عدد المتطوعين</th>
                            <th class="pb-3 hidden md:table-cell">تاريخ البدء</th>
                            <th class="pb-3">الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($opportunities as $opportunity)
                            <tr class="border-b border-gray-100">
                                <td class="py-3 pr-4"> {{ $opportunity->title }} </td>
                                <td class="py-3 hidden md:table-cell">{{ $opportunity->accepted_count }}/ {{ $opportunity->count }}</td>
                                <td class="py-3 hidden md:table-cell"> {{ \Carbon\Carbon::parse($opportunity->start_date)->format('d M Y') }}</td>
                                <td class="py-3"><div>
                                        <x-layouts.status-opportunity :opportunity="$opportunity" />
                                    </div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Volunteers and Stats in 2 columns -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Volunteers -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium">آخر المتطوعين المنضمين</h2>
                </div>
                <div class="p-4">
                    <ul>
                        @foreach($volunteers as $volunteer)
                            <li class="flex items-center py-3 border-b border-gray-100">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=أحمد+محمد&background=106665&color=fff" alt="صورة المتطوع">
                                <div class="mr-3 flex-1">
                                    <p class="text-sm font-medium">{{ $volunteer->first_name . ' ' . $volunteer->last_name }}</p>
                                    <p class="text-xs text-gray-500">{{  $volunteer->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-xs text-white bg-primary rounded-full px-2 py-1">5 ساعات تطوع</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">طلبات الانضمام المعلقة</h2>
                </div>
                <div class="p-4">
                    <ul>
                        @foreach($requests as $request)
                            <li class="flex items-center py-3 border-b border-gray-100">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=عمر+خالد&background=106665&color=fff" alt="صورة المتطوع">
                                <div class="mr-3 flex-1">
                                    <p class="text-sm font-medium">{{ $request->volunteer->first_name . ' ' . $request->volunteer->last_name  }}</p>
                                    <p class="text-xs text-gray-500">
                                        تقدم بطلب {{ $request->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div>
                                    <button class="px-3 py-1 btn-primary  text-xs  ml-1"  wire:click="setModel('accepted' , {{ $request->id }})">قبول</button>
                                    <button class="px-3 py-1 btn-secondary  text-xs" wire:click="setModel('declined',{{ $request->id }})"> رفض</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
