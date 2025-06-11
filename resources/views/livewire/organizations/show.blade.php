<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- الجانب الأيسر - الفرص التطوعية -->
        <div class="lg:w-1/2">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">الفرص التطوعية التي قدمتها مؤسسة</h2>

            @foreach($organization->opportunities as $opportunity)
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6 border-l-4 border-primaryLight">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $opportunity->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($opportunity->description, 200) }}</p>
                        <div class="flex flex-row justify-between items-center">
                            <a href="{{ route('opportunities.show', $opportunity->id) }}" class="inline-block bg-primary hover:bg-primaryLight text-white font-medium py-2 px-6 rounded transition duration-300">
                                عرض تفاصيل الفرصة
                            </a>
                            <x-layouts.status-opportunity :opportunity="$opportunity" />
                        </div>
                    </div>
                </div>
            @endforeach

            @if(count($organization->opportunities) == 0)
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <p class="text-gray-500">لا توجد فرص تطوعية قدمتها المؤسسةً</p>
                </div>
            @endif
        </div>

        <!-- الجانب الأيمن - معلومات المؤسسة -->
        <div class="lg:w-1/2 sticky">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- صورة المؤسسة -->
                <div class="h-48 bg-gray-200 overflow-hidden">
                    @if($organization->user && $organization->user->img_url)
                        <img src="{{ $organization->user->img_url }}" alt="{{ $organization->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <span class="text-gray-400">لا توجد صورة</span>
                        </div>
                    @endif
                </div>

                <!-- تفاصيل المؤسسة -->
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $organization->name }}</h1>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-700">{{ $organization->contact_email }}</span>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-700">{{ $organization->phone_number }}</span>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ $organization->city->name }}</span>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-primary mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span class="text-gray-700">{{ $organization->sector->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
