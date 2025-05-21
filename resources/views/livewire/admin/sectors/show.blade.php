<div class="container mx-auto px-4 py-8">
    <!-- Sector Header -->
    <div class="mb-8 text-center border-b-2 border-gray-200 pb-4">
        <h1 class="text-3xl font-bold text-gray-800">{{ $sector->name }}</h1>
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
            <!-- organizations -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($organizations as $organization)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $organization->name }}</h3>
                            <div class="space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-medium">البريد الإلكتروني:</span>
                                    {{ $organization->contact_email }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">الهاتف:</span>
                                    {{ $organization->phone_number }}
                                </p>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ Str::limit($organization->bio, 120) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="my-2 mx-auto flex flex-col md:flex-row justify-center items-center max-w-[992px] gap-6">
                {{ $organizations->links('vendor.pagination.custom' , data: ['scrollTo' => '#top']) }}
            </div>
        @elseif($activeTab === 'opportunities')
            <!-- opportunities -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($opportunities as $opportunity)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
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
