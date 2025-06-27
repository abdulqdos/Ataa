<div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- City Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $city->name }}</h1>
        <div class="w-24 h-1 bg-primaryLight mx-auto"></div>
    </div>

    <!-- Organizations Grid -->
    @if($organizations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($organizations as $organization)
                <div class="bg-white border border-gray-100 rounded-lg overflow-hidden hover:-translate-y-2 duration-200 shadow-sm">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $organization->name }}</h3>
                            @if($organization->sector->name)
                                <span class="inline-block bg-secondaryLight/20 text-primary text-xs px-2 py-1 rounded-full whitespace-nowrap overflow-hidden text-ellipsis max-w-[120px">
                                    {{ $organization->sector->name }}
                                </span>
                            @endif
                        </div>

                        <div class="space-y-3 text-gray-600">
                            @if($organization->contact_email)
                                <p class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $organization->contact_email }}
                                </p>
                            @endif

                            @if($organization->phone_number)
                                <p class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    {{ $organization->phone_number }}
                                </p>
                            @endif

                            @if($organization->bio)
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $organization->bio }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white border border-gray-100 rounded-lg p-8 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-700 mb-2">لا توجد مؤسسات متاحة</h3>
            <p class="text-gray-500">لا توجد مؤسسات مسجلة في هذه المدينة حالياً.</p>
        </div>
    @endif

    <!-- Pagination -->
    @if($organizations->count() > 0)
        <div class="mt-10 flex justify-center">
            {{ $organizations->links('vendor.pagination.custom', ['scrollTo' => '#top']) }}
        </div>
    @endif
</div>
