<div class="max-w-4xl mx-4 lg:mx-auto bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden my-10">
    @if($showRequestForm)
        <livewire:opportunity.request-form :opportunity="$opportunity->id" />
    @endif

    <div class="flex flex-col md:flex-row">
        <!-- صورة الفرصة -->
        @if($opportunity->img_url !== null)
            <img class="object-cover w-full md:w-1/3 h-64 md:h-auto" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="">
        @else
            <img class="object-cover w-full md:w-1/3 h-64 md:h-auto" src="https://ui-avatars.com/api/?name={{ urlencode($opportunity->title) }}&background=random&color=fff" alt="صورة المؤسسة">
        @endif

        <!-- بيانات الفرصة -->
        <div class="p-6 flex-1">
            <div class="flex items-center justify-between">
                <!-- حالة الفرصة -->
                <x-layouts.status-opportunity :opportunity="$opportunity" />

                @if($opportunity->has_certificate)
                    <div class="bg-green-100 text-green-800 px-3 py-1 rounded-md text-sm flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                        </svg>
                        <span>شهادة</span>
                    </div>
                @endif
            </div>


            <!-- العنوان -->
            <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $opportunity->title }}</h2>

            <!-- الوصف -->
            <p class="mt-2 text-gray-700">{{ $opportunity->description }}</p>

            <!-- التواريخ -->
            <div class="mt-3 text-sm text-gray-600 space-y-1">
                @if($opportunity->start_time && $opportunity->end_time)
                    <p>
                        ⏰ <strong>الوقت:</strong> من {{ \Carbon\Carbon::parse($opportunity->start_time)->format('H:i') }}
                        إلى {{ \Carbon\Carbon::parse($opportunity->end_time)->format('H:i') }}
                    </p>
                @endif

                <p>
                    🗓 <strong>تاريخ البداية:</strong> {{ \Carbon\Carbon::parse($opportunity->start_date)->translatedFormat('d M Y') }}
                </p>

                <p>
                    🏁 <strong>تاريخ النهاية:</strong> {{ \Carbon\Carbon::parse($opportunity->end_date)->translatedFormat('d M Y') }}
                </p>
            </div>


            <!-- الموقع -->
            <div class="mt-3 text-sm text-gray-600">
                 <strong>الموقع:</strong> {{ $opportunity->location }}
                @if($opportunity->location_url)
                    <br> <a href="{{ $opportunity->location_url }}" target="_blank" class="text-blue-600 hover:underline">عرض على الخريطة</a>
                @endif
            </div>

            <!-- Sector -->
            <div class="mt-3 text-sm text-gray-600">
                <strong> النطاق : </strong>
                <span> {{ $opportunity->sector->name }} </span>
            </div>

            <!-- العدد المطلوب -->
            <span class="mt-3 text-sm text-gray-600 font-semibold">المتطوعين المطلوبين:</span> {{ $opportunity->count }} / {{ $opportunity->accepted_count }}

            <!-- الأزرار -->
            <div class="mt-6 flex space-x-4">
                @if($opportunity->getStatus() === 'completed')
                    <button disabled class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg shadow-md disabled:bg-primaryLight cursor-default">
                        هاذي فرصة مكتملة .
                    </button>

                @else
                    @auth
                        @if($submitted)
                            <button disabled class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg shadow-md disabled:bg-primaryLight cursor-default">
                                لقد سجلت بنجاح .
                            </button>
                        @else
                            <button wire:click="toggle" class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg shadow-md hover:bg-primaryLight cursor-pointer ">
                                التسجيل في الفرصة
                            </button>
                        @endif
                    @endauth
                    @guest
                        <a href="/login" wire:navigate.keep class="px-4 py-2 btn-primary text-white text-sm font-semibold  shadow-md cursor-pointer">
                            التسجيل في الفرصة
                        </a>
                    @endguest
                @endif

                <a href="{{ route('opportunities') }}" wire:navigate.keep class="px-4 py-2 btn-secondary text-white text-sm font-semibold">
                    العودة
                </a>
            </div>
        </div>
    </div>
</div>

