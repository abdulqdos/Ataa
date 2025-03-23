<div class="max-w-4xl mx-4 lg:mx-auto bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden my-10">
    @if($showRequestForm)
        <livewire:opportunity.request-form :opportunity="$opportunity->id" />
    @endif

    <div class="flex flex-col md:flex-row">
        <!-- صورة الفرصة -->
        <img class="object-cover w-full md:w-1/3 h-64 md:h-auto" src="{{ \Illuminate\Support\Facades\Storage::url($opportunity->img_url) }}" alt="">

        <!-- بيانات الفرصة -->
        <div class="p-6 flex-1">
            <!-- حالة الفرصة -->
            <span class="w-4 px-4 py-1  rounded-md
                @if($opportunity->status == 'active') bg-green-100 text-green-500
                @elseif($opportunity->status == 'completed') bg-blue-100 text-blue-500
                @else bg-yellow-100 text-yellow-600 @endif">

                @if($opportunity->status === 'active')
                    نشط
                @elseif($opportunity->status === 'upcoming')
                    قريباً
                @elseif($opportunity->status === 'completed')
                    مكتملة
                @endif
            </span>

            <!-- العنوان -->
            <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $opportunity->title }}</h2>

            <!-- الوصف -->
            <p class="mt-2 text-gray-700">{{ $opportunity->description }}</p>

            <!-- التواريخ -->
            <p class="mt-3 text-sm text-gray-600">
                🗓 **البداية:** {{ \Carbon\Carbon::parse($opportunity->start_date)->translatedFormat('d M Y') }}
                | 🏁 **النهاية:** {{ \Carbon\Carbon::parse($opportunity->end_date)->translatedFormat('d M Y') }}
            </p>

            <!-- الموقع -->
            <div class="mt-3 text-sm text-gray-600">
                📍 <strong>الموقع:</strong> {{ $opportunity->location }}
                @if($opportunity->location_url)
                    <br>🔗 <a href="{{ $opportunity->location_url }}" target="_blank" class="text-blue-600 hover:underline">عرض على الخريطة</a>
                @endif
            </div>

            <!-- العدد المطلوب -->
            <p class="mt-3 text-sm text-gray-600">👥 **عدد المتطوعين المطلوب:** {{ $opportunity->count }}</p>

            <!-- الأزرار -->
            <div class="mt-6 flex space-x-4">
                @auth
                    @if($opportunity->status === 'completed')
                        <button disabled class="px-4 py-2 bg-[var(--primary)] text-white text-sm font-semibold rounded-lg shadow-md disabled:bg-[var(--primaryLight)] cursor-default">
                            هاذي فرصة مكتملة .
                        </button>
                    @elseif($submitted)
                        <button disabled class="px-4 py-2 bg-[var(--primary)] text-white text-sm font-semibold rounded-lg shadow-md disabled:bg-[var(--primaryLight)] cursor-default">
                            لقد سجلت بنجاح .
                        </button>
                    @else
                        <button wire:click="toggle" class="px-4 py-2 bg-[var(--primary)] text-white text-sm font-semibold rounded-lg shadow-md hover:bg-[var(--primaryLight)] cursor-pointer">
                            التسجيل في الفرصة
                        </button>
                    @endif

                @endauth
                @guest
                        <a href="/login" wire:navigate class="px-4 py-2 bg-[var(--primary)] text-white text-sm font-semibold rounded-lg shadow-md hover:bg-[var(--primaryLight)] cursor-pointer">
                            التسجيل في الفرصة
                        </a>
                @endguest
                <a href="{{ route('opportunities') }}" wire:navigate class="px-4 py-2 bg-[var(--darkGray)] text-white text-sm font-semibold rounded-lg shadow-md hover:bg-[var(--lightGray)]">
                    العودة
                </a>
            </div>
        </div>
    </div>
</div>

