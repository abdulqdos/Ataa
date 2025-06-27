<div class="container mx-auto px-4 py-8">
    <!-- Sector Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $sector->name }}</h1>
        <div class="w-24 h-1 bg-primaryLight mx-auto"></div>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-lg p-1 shadow-sm">
            <nav class="flex gap-2" aria-label="Tabs">
                <button
                    type="button"
                    class="px-6 py-2 text-sm font-medium rounded-md transition-colors duration-200 cursor-pointer {{ $activeTab === 'organizations' ? 'bg-gray-100 text-primary' : 'text-gray-600 hover:bg-gray-100' }}"
                    wire:click="setActiveTab('organizations')"
                >
                    المؤسسات
                </button>
                <button
                    type="button"
                    class="px-6 py-2 text-sm font-medium rounded-md transition-colors duration-200 cursor-pointer {{ $activeTab === 'opportunities' ? 'bg-gray-100 text-primary' : 'text-gray-600 hover:bg-gray-100' }}"
                    wire:click="setActiveTab('opportunities')"
                >
                    الفرص
                </button>
            </nav>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="space-y-8">
        @if($activeTab === 'organizations')
            <!-- Organizations Grid -->
            @if($organizations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($organizations as $organization)
                        <div class="bg-white border border-gray-100 rounded-lg overflow-hidden hover:-translate-y-2 duration-200 shadow-sm cursor-pointer">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $organization->name }}</h3>
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
            <div class="my-2 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                {{ $organizations->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
            </div>
        @elseif($activeTab === 'opportunities')
            <!-- opportunities -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($opportunities as $opportunity)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:-translate-y-2 transition duration-300 cursor-pointer">
                        <div class="h-48 overflow-hidden"> <!-- حاوية ثابتة الارتفاع للصورة -->
                            @if($opportunity->img_url === null)
                                <img class="w-full h-full object-cover"
                                     src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff"
                                     alt="{{ $opportunity->title }}">
                            @else
                                <img class="w-full h-full object-cover"
                                     src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}"
                                     alt="{{ $opportunity->title }}">
                            @endif
                        </div>
                        <div class="p-6 space-y-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $opportunity->title }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ Str::limit($opportunity->description, 150) }}
                            </p>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar-day text-gray-400"></i>
                                    <span>{{ $opportunity->start_date->format('Y-m-d') }} - {{ $opportunity->end_date->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    @if($opportunity->location_url)
                                        <a href="{{ $opportunity->location_url }}" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">
                                            {{ $opportunity->location }}
                                        </a>
                                    @else
                                        <span>{{ $opportunity->location }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="my-2 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                {{ $opportunities->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
            </div>
        @endif
    </div>
</div>
