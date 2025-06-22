<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <x-layouts.header
        title="سجل الأنشطة"
        :breadcrumbs="[['الرئيسية', route('organization.dashboard')], ['سجل الأنشطة']]">
    </x-layouts.header>

    <div class="mt-8 bg-white rounded-xl shadow-soft">
        @if($activities->count() > 0)
            <div class="overflow-hidden rounded-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                تفاصيل النشاط
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                المستخدم
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                الوقت
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($activities as $index => $activity)
                            <tr class="transition-all hover:bg-gray-50/50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900">
                                    <div class="flex justify-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 text-primary font-semibold">
                                            {{ $index + 1 }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <div class="flex-shrink-0">
                                            <x-layouts.event :event="$activity->event" />
                                        </div>
                                        <div class="text-sm text-center font-medium text-gray-800">
                                            {{ $activity->description }}
                                            بإسم
                                            {{
                                                  $activity->subject?->name
                                                  ?? $activity->subject?->title
                                                  ?? data_get($activity->properties, 'data.data.attributes.title')
                                                  ?? data_get($activity->properties, 'data.data.old.title')
                                            }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-sm text-center text-gray-700 font-medium">
                                            @if($activity->causer_type === "App\Models\Organization")
                                                {{ $activity->causer->name }}
                                            @else
                                                {{ $activity->causer->user_name ?? "النظام"}}
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex justify-center">
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $activity->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 px-6 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-primary/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="mt-5 text-lg font-semibold text-gray-800">لا توجد أنشطة مسجلة</h3>
                <p class="mt-2 text-sm text-gray-600 max-w-md mx-auto">لم يتم تسجيل أي أنشطة حتى الآن. سيظهر هنا أي نشاط يتم تنفيذه على النظام.</p>
                <div class="mt-6">
                    <a href="{{ route('organization.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        العودة للرئيسية
                    </a>
                </div>
            </div>
        @endif
    </div>

    @if($activities->count() > 0)
        <div class="mt-8 flex justify-center">
            {{ $activities->links('vendor.pagination.custom', data: ['scrollTo' => '#top']) }}
        </div>
    @endif
</div>
