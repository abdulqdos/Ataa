<div class="max-w-4xl mx-4 lg:mx-auto bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden my-10 relative">
    <!-- زر العودة -->
    <a href="{{ url()->previous() }}" class="absolute top-4 left-4 text-gray-600 hover:text-gray-900">
        ← العودة
    </a>

    <div class="flex flex-col md:flex-row">
        <!-- صورة الفرصة -->
        @if($request->opportunity->img_url !== null)
            <img class="object-cover w-full md:w-1/3 h-64 md:h-auto" src="{{ \Illuminate\Support\Facades\Storage::url($request->opportunity->img_url) }}" alt="">
        @else
            <img class="object-cover w-full md:w-1/3 h-64 md:h-auto" src="https://ui-avatars.com/api/?name={{ urlencode($request->opportunity->title) }}&background=random&color=fff" alt="">
        @endif

        <!-- بيانات الفرصة -->
        <div class="p-6 flex-1">
            <!-- حالة الفرصة -->
            <span class="px-3 py-1 text-xs font-semibold rounded-md
                        @if($request->status == 'accepted') bg-green-100 text-green-600
                        @elseif($request->status == 'pending') bg-yellow-100 text-yellow-600
                        @else bg-red-100 text-red-600 @endif">
                        @if($request->status === 'accepted')
                    مقبول
                @elseif($request->status === 'pending')
                    قيد الانتظار
                @elseif($request->status === 'declined')
                    مرفوض
                @endif
            </span>

            <!-- العنوان -->
            <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $request->opportunity->title }}</h2>

            <!-- اسم المتطوع -->
            <p class="mt-3 text-sm text-gray-600 font-semibold">
                👤 المتطوع: <a href="#" class="text-blue-600 hover:underline">{{ $request->volunteer->first_name . ' ' . $request->volunteer->last_name }}</a>
            </p>

            <!-- السبب -->
            <div class="mt-3">
                <strong class="text-gray-800">السبب:</strong>
                <p class="mt-1 text-gray-700 bg-gray-100 p-3 rounded-lg">{{ $request->reason }}</p>
            </div>

            <!-- الموقع -->
            <div class="mt-3 text-sm text-gray-600">
                📍 <strong>الموقع:</strong> {{ $request->opportunity->location }}
                @if($request->opportunity->location_url)
                    <br>🔗 <a href="{{ $request->opportunity->location_url }}" target="_blank" class="text-blue-600 hover:underline">عرض على الخريطة</a>
                @endif
            </div>

            <!-- الأزرار -->
            <div class="mt-6 flex space-x-4">
                <button class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg shadow-md hover:bg-primaryLight cursor-pointer">
                    قبول
                </button>
                <button wire:navigate class="px-4 py-2 btn-secondary text-white text-sm font-semibold shadow-md">
                    رفض
                </button>
            </div>
        </div>
    </div>
</div>
