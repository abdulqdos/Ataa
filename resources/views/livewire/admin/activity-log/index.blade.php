<div class="relative overflow-x-auto  px-3 py-1   mx-2 md:mx-5">
    <x-layouts.header title="سجل الأنشطة"
                      :breadcrumbs="[['الرئيسية', route('organization.dashboard')], ['سجل الأنشطة']]">
    </x-layouts.header>

    <div class="bg-white shadow-sm">
        @if($activities->count() > 0)
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                        id
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                        النشاط
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                        الفاعل
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center text-xs font-medium text-gray-500 md:px-6">
                                        التاريخ
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                @foreach($activities as $index => $activity)
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-800 md:px-6">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6 flex flex-row gap-6 items-center justify-center">
                                            <x-layouts.event :event="$activity->event" />
                                            {{ $activity->description }}
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                            @if($activity->causer_type === "App\Models\Organization")
                                                <p>  {{ $activity->causer->name }}</p>
                                            @else
                                                {{ $activity->causer->user_name ?? "System"}}
                                            @endif
                                        </td>
                                        <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-800 md:px-6">
                                            {{ $activity->created_at->diffForHumans() }}
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
            <!-- Empty State -->
            <div class="bg-primary/20 border border-secondaryLight rounded-xl p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-3 text-lg font-medium text-gray-800">لا توجد أنشطة مسجلة</h3>
                <p class="mt-1 text-sm text-gray-600">لا يوجد سجل للأنشطة حتى الآن.</p>
            </div>
        @endif
    </div>

    <div class="my-6 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
        {{ $activities->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
    </div>
</div>
