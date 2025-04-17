<div class="m-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">الفرص التطوعية المسجلة</h1>
                <p class="text-gray-500 text-sm mt-1">إدارة وتتبع الفرص التطوعية التي سجلت فيها</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">عدد الفرص:</span>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $opportunities->count() }}</span>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="grid grid-cols-1 items-center lg:grid-cols-4 gap-4 mb-6">
            <!-- Search Box -->
            <div class="lg:col-span-2">
                <label for="table-search" class="block text-sm font-medium text-gray-600 mb-1">بحث</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                           wire:model.live.debounce.300ms="searchText"
                           class="w-full pr-10 py-2.5 text-sm text-gray-900 border border-gray-200 rounded-lg bg-gray-50
                           focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all"
                           placeholder="ابحث باسم الفرصة...">
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-600 mb-1">حالة الفرصة</label>
                <select id="status" name="status"
                        class="w-full py-2.5 px-3 text-sm text-gray-900 border border-gray-200 rounded-lg bg-gray-50
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all"
                        wire:model.live="status">
                    <option value="">جميع الحالات</option>
                    <option value="upcoming">قريباً</option>
                    <option value="active">نشطة</option>
                    <option value="completed">مكتملة</option>
                </select>
            </div>
        </div>

        <!-- Opportunities Table -->
        @if($opportunities->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الفرصة
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            التواريخ
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الحالة
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            الإجراءات
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($opportunities as $opportunity)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Opportunity Info -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($opportunity->img_url === null)
                                        <img class="h-10 w-10 rounded-lg" src="https://ui-avatars.com/api/?name={{ $opportunity->title }}&background=random&color=fff" alt="صورة الفرصة">
                                    @else
                                        <img class="h-10 w-10 rounded-lg" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="صورة الفرصة">
                                    @endif
                                    <div class="text-right">
                                        <a href="{{ route('organization.opportunity.show', $opportunity->id) }}"
                                           class="block font-medium text-gray-900 hover:text-blue-600 transition">
                                            {{ $opportunity->title }}
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $opportunity->description }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Dates -->
                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($opportunity->start_date)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($opportunity->end_date)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                <livewire:opportunity-status :opportunity="$opportunity" wire:key="{{ $opportunity->id }}" />
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    @if($opportunity->status === 'upcoming')
                                        <button class="text-red-500 hover:text-red-700 transition-colors group flex flex-col items-center"
                                                wire:click="cancelRegistration({{ $opportunity->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span class="text-xs mt-1">إلغاء التسجيل</span>
                                        </button>
                                    @endif
                                    <a href="{{ route('organization.opportunity.show', $opportunity->id) }}"
                                       class="text-blue-500 hover:text-blue-700 transition-colors group flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="text-xs mt-1">عرض التفاصيل</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                {{ $opportunities->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-3 text-lg font-medium text-gray-800">لا توجد فرص مسجلة</h3>
                <p class="mt-1 text-sm text-gray-600">لم تقم بالتسجيل في أي فرصة تطوعية بعد. يمكنك استعراض الفرص المتاحة والتسجيل فيها.</p>
                <div class="mt-4">
                    <a href="{{ route('opportunities') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        استعراض الفرص
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>


